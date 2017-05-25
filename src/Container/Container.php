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
    public static function boot() : void
    {
        self::$container = new \League\Container\Container;
        self::$container->delegate(
            new \League\Container\ReflectionContainer
        );
        self::register();
    }

    /**
     * @return \League\Container\Container
     */
    public static function instance() : \League\Container\Container
    {
        return self::$container;
    }

    /**
     * @param string $alias
     * @return Containable
     */
    public static function get(string $alias) :  Containable
    {
        return self::$container->get($alias);
    }

    /**
     *
     */
    public static function register() : void
    {
        self::$container->share('GuzzleClient', function () {
            return new Guzzle();
        });
    }
}
