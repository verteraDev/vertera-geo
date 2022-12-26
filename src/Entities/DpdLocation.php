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
    public ?string $code_name = null;

    /**
     * @var string|null
     */
    public ?string $country_name = null;

    /**
     * @var string|null
     */
    public ?string $country_code = null;

    /**
     * @var string|null
     */
    public ?string $region_code = null;

    /**
     * @var string|null
     */
    public ?string $region_name = null;

    /**
     * @var int|null
     */
    public ?int $city_id = null;

    /**
     * @var string|null
     */
    public ?string $city_code = null;

    /**
     * @var string|null
     */
    public ?string $city_name = null;

    /**
     * @var string|null
     */
    public ?string $city_abbr = null;

    /**
     * @var int|null
     */
    public ?int $location_id = null;
    /**
     * @var string|null
     */
    public ?string $is_cash_pay = null;

    /**
     * @var string|null
     */
    public ?string $orig_name = null;

    /**
     * @var string|null
     */
    public ?string $orig_name_lower = null;
}
