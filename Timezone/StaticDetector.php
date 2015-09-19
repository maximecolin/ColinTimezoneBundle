<?php

namespace Colin\Bundle\TimezoneBundle\Timezone;

class StaticDetector implements DetectorInterface
{
    private $timezone;

    public function __construct($timezone)
    {
        $this->timezone = $timezone;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }
}
