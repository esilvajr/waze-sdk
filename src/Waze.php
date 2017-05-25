<?php

namespace Waze;

use Waze\Config\Auth;
use Waze\Maps\Maps;
use Waze\Container\Container;
use Waze\Routing\Routing;

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

    /**
     * @return Routing
     */
    public function routing() : Routing
    {
        return new Routing();
    }
}
