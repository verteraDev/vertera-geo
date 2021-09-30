<?php

namespace VerteraGeo\Entities;

/**
 * Class Location
 * @package VerteraGeo\Entities
 */
class Location
{
    /**
     * @var int
     */
    public int $const;

    /**
     * @var int
     */
    public int $update_id;

    /**
     * @var Translation[]
     */
    public array $name;
}
