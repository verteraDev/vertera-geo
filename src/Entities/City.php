<?php

namespace VerteraGeo\Entities;

/**
 * Class City
 * @package VerteraGeo\Entities
 */
class City
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
     * @var int|null
     */
    public ?int $region_id;

    /**
     * @var Translation[]|null
     */
    public ?array $name;

    /**
     * @var Translation[]|null
     */
    public ?array $area;

    /**
     * @var bool|null
     */
    public ?bool $impotant;

    /**
     * @var bool|null
     */
    public ?bool $show_in_request;

    /**
     * @var float|null
     */
    public ?float $lat;

    /**
     * @var float|null
     */
    public ?float $lng;

    /**
     * @var array|null
     */
    public ?array $phone_code_json;

    /**
     * @var int|null
     */
    public ?int $time_zone_num;

    /**
     * @var int|null
     */
    public ?int $level_const;

    /**
     * @var string|null
     */
    public ?string $iso;

    /**
     * @var string|null
     */
    public ?string $wiki;

    /**
     * @var bool|null
     */
    public ?bool $is_capital;

    /**
     * @var int|null
     */
    public ?int $dpd_location_city_id;
}
