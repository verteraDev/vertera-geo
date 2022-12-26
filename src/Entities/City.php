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
    public ?int $country_id = null;

    /**
     * @var int|null
     */
    public ?int $region_id = null;

    /**
     * @var Translation[]|null
     */
    public ?array $name = null;

    /**
     * @var Translation[]|null
     */
    public ?array $area = null;

    /**
     * @var bool|null
     */
    public ?bool $impotant = null;

    /**
     * @var bool|null
     */
    public ?bool $show_in_request = null;

    /**
     * @var float|null
     */
    public ?float $lat = null;

    /**
     * @var float|null
     */
    public ?float $lng = null;

    /**
     * @var array|null
     */
    public ?array $phone_code_json = null;

    /**
     * @var int|null
     */
    public ?int $time_zone_num = null;

    /**
     * @var int|null
     */
    public ?int $level_const = null;

    /**
     * @var string|null
     */
    public ?string $iso = null;

    /**
     * @var string|null
     */
    public ?string $wiki = null;

    /**
     * @var bool|null
     */
    public ?bool $is_capital = null;

    /**
     * @var int|null
     */
    public ?int $dpd_location_city_id = null;
}
