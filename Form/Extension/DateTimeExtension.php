<?php

namespace Colin\Bundle\TimezoneBundle\Form\Extension;


abstract class DateTimextension extends AbstractTimezoneExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'datetime';
    }
}
