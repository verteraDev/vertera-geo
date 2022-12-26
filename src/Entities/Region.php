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
    public ?int $country_id = null;

    /**
     * @var Translation[]|null
     */
    public ?array $name = null;

    /**
     * @var array|null
     */
    public ?array $autocod_json = null;

    /**
     * @var string|null
     */
    public ?string $iso = null;

    /**
     * @var float|null
     */
    public ?float $lat = null;

    /**
     * @var float|null
     */
    public ?float $lng = null;
}
