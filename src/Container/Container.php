<?php

namespace Waze\Container;
use Waze\Config\Guzzle;


/**
 * Class Container
 * @package Waze\Container
 */
class Container
{

    /**
     * @var
     */
    static private $container;


    /**
     *
     */
    static public function boot() : void
    {
        self::$container = new \League\Container\Container;
        self::$container->delegate(
            new \League\Container\ReflectionContainer
        );
        self::register();
    }

    /**
     * @return Container
     */
    static public function instance() : \League\Container\Container
    {
        return self::$container;
    }

    /**
     * @param string $alias
     * @return mixed
     */
    static public function get(string $alias) :  Containable
    {
        return self::$container->get($alias);
    }

    /**
     *
     */
    static public function register() : void
    {
        self::$container->share('GuzzleClient', function () {
            return new Guzzle();
        });
    }

}