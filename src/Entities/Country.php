<?php

namespace VerteraGeo\Entities;

/**
 * Class Country
 * @package VerteraGeo\Entities
 */
class Country
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
     * @var Translation[]|null
     */
    public ?array $name = null;

    /**
     * @var Translation[]|null
     */
    public ?array $fullname = null;

    /**
     * @var int|null
     */
    public ?int $phone_code = null;

    /**
     * @var string|null
     */
    public ?string $iso = null;

    /**
     * @var string|null
     */
    public ?string $alpha3 = null;

    /**
     * @var string|null
     */
    public ?string $alpha2 = null;

    /**
     * @var int|null
     */
    public ?int $num_code = null;

    /**
     * @var int|null
     */
    public ?int $mcc = null;

    /**
     * @var int|null
     */
    public ?int $location_const = null;

    /**
     * @var array|null
     */
    public ?array $lang_json = null;

    /**
     * @var string|null
     */
    public ?string $language = null;

    /**
     * @var bool|null
     */
    public ?bool $is_active = null;

    /**
     * @var int|null
     */
    public ?int $capital_id = null;

    /**
     * @var float|null
     */
    public ?float $lat = null;

    /**
     * @var float|null
     */
    public ?float $lng = null;

    /**
     * @var string|null
     */
    public ?string $currency_code = null;

    /**
     * @var int|null
     */
    public ?int $os_id = null;
}
