<?php

namespace Colin\Bundle\TimezoneBundle\Form\Extension;

abstract class DateExtension extends AbstractTimezoneExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'date';
    }
}
