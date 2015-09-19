<?php

namespace Colin\Bundle\TimezoneBundle\Timezone;

class ChainDetector implements DetectorInterface
{
    /**
     * @var DetectorInterface[]
     */
    private $detectors;

    /**
     * @param DetectorInterface[] $detectors
     */
    public function __construct(array $detectors)
    {
        array_walk($detectors, function (&$item) {
            if (!$item instanceof DetectorInterface) {
                throw new \InvalidArgumentException('Array of DetectorInterface expected');
            }
        });

        $this->$detectors = $detectors;
    }

    public function getTimezone()
    {
        foreach ($this->detectors as $detector) {
            if ($timezone = $detector->getTimezone()) {
                return $timezone;
            }
        }

        return null;
    }
}
