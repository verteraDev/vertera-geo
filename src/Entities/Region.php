<?php

namespace VerteraGeo\Entities;

/**
 * Class Region
 * @package VerteraGeo\Entities
 */
class Region
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var int
     */
    public int $update_id;

    /**
     * @var int|null
     */
    public ?int $country_id;

    /**
     * @var Translation[]|null
     */
    public ?array $name;

    /**
     * @var array|null
     */
    public ?array $autocod_json;

    /**
     * @var string|null
     */
    public ?string $iso;

    /**
     * @var float|null
     */
    public ?float $lat;

    /**
     * @var float|null
     */
    public ?float $lng;
}
