<?php

namespace VerteraGeo\Entities;

use DateTime;

/**
 * Class Update
 * @package VerteraGeo\Entities
 */
class Update
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $url;

    /**
     * @var DateTime
     */
    public DateTime $created_at;

    /**
     * Update constructor.
     * @param int $id
     * @param string $url
     * @param DateTime $created_at
     */
    public function __construct(
        int $id,
        string $url,
        DateTime $created_at
    )
    {
        $this->id = $id;
        $this->url = $url;
        $this->created_at = $created_at;
    }
}
