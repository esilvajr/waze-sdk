<?php

namespace Waze\Routing;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class At
 * @package Waze\Routing
 */
class At
{
    /**
     * @param array $options
     * @return float|int
     */
    public function get(array $options) : int
    {
        $options = $this->resolveOptions($options);

        $now = new \DateTime('now');

        $period = $this->period($options);

        $diff = $period->format('U') - $now->format('U');

        return $diff/60;
    }

    /**
     * @param array $options
     * @return \DateTime
     */
    private function period(array $options) : \DateTime
    {
        if ($options['now']) {
            return new \DateTime('now');
        }
        return new \DateTime($options['period']);
    }

    /**
     * @param array $options
     * @return array
     */
    private function resolveOptions(array $options) : array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefined([
            'now',
            'period'
        ]);

        $resolver->addAllowedValues('now', [true, false]);

        $resolver->addAllowedValues('period', [
            '00:00',
            '00:30',
            '01:00',
            '01:30',
            '02:00',
            '02:30',
            '03:00',
            '03:30',
            '04:00',
            '04:30',
            '05:00',
            '05:30',
            '06:00',
            '06:30',
            '07:00',
            '07:30',
            '08:00',
            '08:30',
            '09:00',
            '09:30',
            '10:00',
            '10:30',
            '11:00',
            '11:30',
            '12:00',
            '12:30',
            '13:00',
            '13:30',
            '14:00',
            '14:30',
            '15:00',
            '15:30',
            '16:00',
            '16:30',
            '17:00',
            '17:30',
            '18:00',
            '18:30',
            '19:00',
            '19:30',
            '20:00',
            '20:30',
            '21:00',
            '21:30',
            '22:00',
            '22:30',
            '23:00',
            '23:30',
        ]);

        $resolver->setDefault('now', false);

        return $resolver->resolve($options);
    }
}
