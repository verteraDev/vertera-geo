<?php

namespace VerteraGeo\Entities;

/**
 * Class DpdLocation
 * @package VerteraGeo\Entities
 */
class DpdLocation
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
     * @var string|null
     */
    public ?string $code_name;

    /**
     * @var string|null
     */
    public ?string $country_name;

    /**
     * @var string|null
     */
    public ?string $country_code;

    /**
     * @var string|null
     */
    public ?string $region_code;

    /**
     * @var string|null
     */
    public ?string $region_name;

    /**
     * @var int|null
     */
    public ?int $city_id;

    /**
     * @var string|null
     */
    public ?string $city_code;

    /**
     * @var string|null
     */
    public ?string $city_name;

    /**
     * @var string|null
     */
    public ?string $city_abbr;

    /**
     * @var int|null
     */
    public ?int $location_id;
    /**
     * @var string|null
     */
    public ?string $is_cash_pay;

    /**
     * @var string|null
     */
    public ?string $orig_name;

    /**
     * @var string|null
     */
    public ?string $orig_name_lower;
}
