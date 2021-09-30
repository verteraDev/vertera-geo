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
    public ?array $name;

    /**
     * @var Translation[]|null
     */
    public ?array $fullname;

    /**
     * @var int|null
     */
    public ?int $phone_code;

    /**
     * @var string|null
     */
    public ?string $iso;

    /**
     * @var string|null
     */
    public ?string $alpha3;

    /**
     * @var string|null
     */
    public ?string $alpha2;

    /**
     * @var int|null
     */
    public ?int $num_code;

    /**
     * @var int|null
     */
    public ?int $mcc;

    /**
     * @var int|null
     */
    public ?int $location_const;

    /**
     * @var array|null
     */
    public ?array $lang_json;

    /**
     * @var bool|null
     */
    public ?bool $is_active;

    /**
     * @var int|null
     */
    public ?int $capital_id;

    /**
     * @var float|null
     */
    public ?float $lat;

    /**
     * @var float|null
     */
    public ?float $lng;

    /**
     * @var string|null
     */
    public ?string $currency_code;

    /**
     * @var int|null
     */
    public ?int $os_id;
}
