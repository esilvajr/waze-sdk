<?php

namespace Waze\Routing;

use Waze\Routing\Request;

/**
 * Class Routing
 * @package Waze\Routing
 */
class Routing
{

    /**
     * @param $options
     * @return array
     */
    public function request(array $options) : array
    {
        return (new Request)->get($options);
    }
}
