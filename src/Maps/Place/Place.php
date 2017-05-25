<?php

namespace Waze\Maps\Place;

/**
 * Class Place
 * @package Waze\Maps\Place
 */
class Place
{

    /**
     * @param array $options
     * @return array
     */
    public function autocomplete(array $options) : array
    {
        return (new Autocomplete())->get($options);
    }

}