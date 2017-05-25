<?php

namespace Waze\Maps\Place;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Waze\Container\Container;

/**
 * Class Details
 * @package Waze\Maps\Autocomplete
 */
class Details
{

    /**
     *
     */
    const ENDPOINT = 'https://www.waze.com/maps/api/place/details/json';

    /**
     * @var
     */
    private $client;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->client = Container::get('GuzzleClient')->client();
    }

    /**
     * @param array $options
     * @return array
     * @throws \Exception
     */
    public function get(array $options) : array
    {
        $options = $this->mergeKey($options);
        $options = $this->resolveOptions($options);

        $response = $this->client->get($this->buildUrl($options));

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), JSON_OBJECT_AS_ARRAY);
        }
        
        throw new \Exception($response->getBody()->getContents(), $response->getStatusCode());
    }

    /**
     * @param $options
     * @return string
     */
    private function buildUrl($options) : string
    {
        $query = http_build_query($options, '&');
        return sprintf('%s%s%s', self::ENDPOINT,'?', $query);
    }

    /**
     * @param $options
     * @return array
     */
    private function mergeKey($options) : array
    {
        $key = Container::get('Config\Auth')->getKey();
        return array_merge($options, ['key' => $key]);
    }

    /**
     * @param array $options
     * @return array
     */
    private function resolveOptions(array $options) : array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefined([
            'reference',
            'sensor',
            'key',
        ]);

        $resolver->setDefaults(array(
            'sensor'     => 'false',
        ));

        $resolver->setRequired([
            'reference',
            'sensor'
        ]);

        return $resolver->resolve($options);
    }
}
