<?php

namespace Colin\Bundle\TimezoneBundle\Form\Extension;

use Colin\Bundle\TimezoneBundle\Timezone\DetectorInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractTimezoneExtension extends AbstractTypeExtension
{
    private $timezoneDetector;

    public function __construct(DetectorInterface $timezoneDetector)
    {
        $this->timezoneDetector = $timezoneDetector;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('view_timezone', $this->timezoneDetector->getTimezone());
    }
}
