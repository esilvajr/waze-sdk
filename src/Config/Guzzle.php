<?php

namespace Waze\Config;

use Waze\Container\Containable;

/**
 * Class Guzzle
 * @package Waze\Config
 */
class Guzzle implements Containable
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Guzzle constructor.
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'timeout' => 2,
            'connect_timeout' => 2,
        ]);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function client() : \GuzzleHttp\Client
    {
        return $this->client;
    }
}
