<?php

namespace VerteraGeo;

use DateTime;
use DOMNode;
use Generator;
use Symfony\Component\HttpClient\Exception\InvalidArgumentException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use VerteraGeo\Entities\City;
use VerteraGeo\Entities\Country;
use VerteraGeo\Entities\DpdLocation;
use VerteraGeo\Entities\Location;
use VerteraGeo\Entities\Region;
use VerteraGeo\Entities\Translation;
use VerteraGeo\Entities\Update;
use XMLReader;
use ZipArchive;

/**
 * Class VerteraGeo
 * @package VerteraGeo
 */
class VerteraGeo
{
    /**
     * @var HttpClientInterface
     */
    public HttpClientInterface $client;

    /**
     * VerteraGeo constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (!key_exists('base_uri', $config)) {
            $config['base_uri'] = 'https://geo.vertera.org/api/';
        }

        if (!key_exists('token', $config)) {
            throw new InvalidArgumentException('Укажите token.');
        }

        $this->client = HttpClient::create([
            'base_uri' => $config['base_uri'],
            'auth_bearer' => $config['token'],
            'headers' => [
                'User-Agent' => 'VerteraGeo Client v0.1',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @param int|null $last_update_id
     * @return Generator
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getUpdates(int $last_update_id = null): Generator
    {
        $options = [
            'query' => [
                'page' => 1,
                'limit' => 5,
            ],
        ];

        $response = $this->client->request('GET', 'updates', $options);

        $content = json_decode($response->getContent(), true);

        if (isset($content['data'])) {
            foreach ($content['data'] as $update) {
                if (!$last_update_id || $update['id'] > $last_update_id) {
                    yield new Update($update['id'], $update['url'], new DateTime($update['created_at']));
                }
            }
        }

        while (isset($content['links']['next']) && !is_null($content['links']['next'])) {
            $options['query']['page']++;

            $response = $this->client->request('GET', 'updates', $options);

            $content = json_decode($response->getContent(), true);

            if (isset($content['data'])) {
                foreach ($content['data'] as $update) {
                    if (!$last_update_id || $update['id'] > $last_update_id) {
                        yield new Update($update['id'], $update['url'], new DateTime($update['created_at']));
                    }
                }
            }
        }
    }

    /**
     * @param Update $update
     * @return Generator
     * @throws TransportExceptionInterface
     */
    public function getUpdateData(Update $update): Generator
    {
        $response = $this->client->request('GET', $update->url);

        $filename = pathinfo($response->getInfo()['url'], PATHINFO_FILENAME);

        $handle = fopen("/tmp/{$filename}.zip", 'w+');
        foreach ($this->client->stream($response) as $chunk) {
            fwrite($handle, $chunk->getContent());
        }
        fclose($handle);

        $zip = new ZipArchive();
        $zip->open("/tmp/{$filename}.zip");
        $zip->extractTo("/tmp");
        $zip->close();

        unlink("/tmp/{$filename}.zip");

        $xml = new XMLReader();
        $xml->open("/tmp/{$filename}.xml");

        while($xml->read()) {
            switch ($xml->nodeType) {
                case XMLReader::ELEMENT:
                    switch ($xml->name) {
                        case 'location':
                            yield $this->parseLocation($update->id, $xml->expand());
                            break;
                        case 'country':
                            yield $this->parseCountry($update->id, $xml->expand());
                            break;
                        case 'region':
                            yield $this->parseRegion($update->id, $xml->expand());
                            break;
                        case 'city':
                            yield $this->parseCity($update->id, $xml->expand());
                            break;
                        case 'dpd-location':
                            yield $this->parseDpdLocation($update->id, $xml->expand());
                            break;
                    }
                    break;
            }
        }

        $xml->close();

        unlink("/tmp/{$filename}.xml");
    }

    /**
     * @param int $update_id
     * @param DOMNode $node
     * @return Location
     */
    private function parseLocation(int $update_id, DOMNode $node): Location
    {
        $location = new Location();

        $location->update_id = $update_id;

        if ($node->hasAttributes()) {
            foreach($node->attributes as $attribute) {
                $location->{$attribute->name} = $attribute->value;
            }
        }

        if ($node->hasChildNodes()) {
            $children = $node->childNodes;
            for ($i = 0; $i < $children->length; $i++) {
                $location->{$children->item($i)->nodeName} = $this->parseAttribute($children->item($i));
            }
        }

        return $location;
    }

    /**
     * @param int $update_id
     * @param DOMNode $node
     * @return Country
     */
    private function parseCountry(int $update_id, DOMNode $node): Country
    {
        $country = new Country();

        $country->update_id = $update_id;
        $country->id = $node->getAttribute('id');

        if ($node->hasChildNodes()) {
            $children = $node->childNodes;
            for ($i = 0; $i < $children->length; $i++) {
                $country->{$children->item($i)->nodeName} = $this->parseAttribute($children->item($i));
            }
        }

        return $country;
    }

    /**
     * @param int $update_id
     * @param DOMNode $node
     * @return Region
     */
    private function parseRegion(int $update_id, DOMNode $node): Region
    {
        $region = new Region();

        $region->update_id = $update_id;
        $region->id = $node->getAttribute('id');

        if ($node->hasChildNodes()) {
            $children = $node->childNodes;
            for ($i = 0; $i < $children->length; $i++) {
                $region->{$children->item($i)->nodeName} = $this->parseAttribute($children->item($i));
            }
        }

        return $region;
    }

    /**
     * @param int $update_id
     * @param DOMNode $node
     * @return City
     */
    private function parseCity(int $update_id, DOMNode $node): City
    {
        $city = new City();

        $city->update_id = $update_id;
        $city->id = $node->getAttribute('id');

        if ($node->hasChildNodes()) {
            $children = $node->childNodes;
            for ($i = 0; $i < $children->length; $i++) {
                $city->{$children->item($i)->nodeName} = $this->parseAttribute($children->item($i));
            }
        }

        return $city;
    }

    /**
     * @param int $update_id
     * @param DOMNode $node
     * @return DpdLocation
     */
    private function parseDpdLocation(int $update_id, DOMNode $node): DpdLocation
    {
        $dpdLocation = new DpdLocation();

        $dpdLocation->update_id = $update_id;
        $dpdLocation->id = $node->getAttribute('id');

        if ($node->hasChildNodes()) {
            $children = $node->childNodes;
            for ($i = 0; $i < $children->length; $i++) {
                $dpdLocation->{$children->item($i)->nodeName} = $this->parseAttribute($children->item($i));
            }
        }

        return $dpdLocation;
    }

    /**
     * @param DOMNode $node
     * @return Translation
     */
    private function parseTranslation(DOMNode $node): Translation
    {
        $translation = new Translation();

        $translation->locale = $node->getAttribute('locale');
        $translation->value = $node->nodeValue;

        return $translation;
    }

    /**
     * @param DOMNode $node
     * @return array|string|null
     */
    private function parseAttribute(DOMNode $node)
    {
        if ($node->hasChildNodes()) {
            $children = $node->childNodes;

            $value = [];
            for ($i = 0; $i < $children->length; $i++) {
                $child = $children->item($i);

                if ($child->nodeName == 'translation') {
                    $value[] = $this->parseTranslation($child);
                } elseif ($child->nodeName == 'item') {
                    $value[] = $this->parseAttribute($child);
                } else {
                    $value = $child->nodeValue;
                    break;
                }
            }
        } else {
            $value = $node->nodeValue;
        }

        return !empty($value) ? $value : null;
    }
}
