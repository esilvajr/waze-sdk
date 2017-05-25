<?php

namespace Waze;

use Waze\Config\Auth;
use Waze\Maps\Maps;
use Waze\Container\Container;

/**
 * Class Waze
 * @package Waze
 */
class Waze
{

    /**
     * Waze constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {

        Container::boot();
        Container::instance()->share('Config\Auth', new Auth($key));
    }

    /**
     * @return Maps
     */
    public function maps() : Maps
    {
        return new Maps();
    }
}
