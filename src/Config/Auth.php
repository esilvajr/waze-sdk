<?php

namespace Waze\Config;

use Waze\Container\Containable;

class Auth implements Containable
{

    private $key;

    /**
     * Auth constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey() : string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getParam() : string
    {
        return get_object_vars(current($this));
    }

}
