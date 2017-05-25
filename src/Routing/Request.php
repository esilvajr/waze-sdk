<?php

namespace Waze\Routing;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Waze\Container\Container;

class Request
{
    /**
     *
     */
    const ENDPOINT = 'https://www.waze.com/row-RoutingManager/routingRequest';

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
        $geolocation = $this->buildGeolocation($options);
        $query = http_build_query($options, '=', '&', PHP_QUERY_RFC3986);
        return sprintf('%s%s%s%s', self::ENDPOINT,'?', $query, $geolocation);
    }

    private function buildGeolocation(array &$options)
    {
        $from  = $options['from'];
        $to = $options['to'];

        unset($options['from']);
        unset($options['to']);

        $from = sprintf('x:%s+y:%s', $from['x'], $from['y']);
        $to = sprintf('x:%s+y:%s', $to['x'], $to['y']);

        $from = str_replace(':', '%3A', $from);
        $to = str_replace(':', '%3A', $to);

        return sprintf('&from=%s&to=%s', $from, $to);
    }

    /**
     * @param array $options
     * @return array
     */
    private function resolveOptions(array $options) : array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefined([
            'from',
            'to',
            'at',
            'returnJSON',
            'returnGeometries',
            'returnInstructions',
            'timeout',
            'nPaths',
            'clientVersion',
            'options',
        ]);

        $resolver->setDefaults(array(
            'at' => 0,
            'returnJSON' => true,
            'returnGeometries' => true,
            'returnInstructions' => true,
            'timeout' => 60000,
            'nPaths' => 3,
            'clientVersion' => '4.0.0',
            'options' => 'AVOID_TRAILS:t,ALLOW_UTURNS:t',
        ));

        $resolver->setRequired([
            'from',
            'to'
        ]);

        return $resolver->resolve($options);
    }
}
//'x%3A-48.1786486+y%3A-21.7848272&to=x%3A-48.3256762+y%3A-21.2525138'
//'x%3A-48.1786486%2By%3A-21.7848272&to=x%3A-48.3256762%2By%3A-21.2525138'
