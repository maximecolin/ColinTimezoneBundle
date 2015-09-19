<?php

namespace Colin\Bundle\TimezoneBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;
    /**
     * @param \Twig_Environment $twig
     */
    function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $core = $this->twig->getExtension('core');

        if ($core instanceof \Twig_Extension_Core) {
            $core->setTimezone('Europe/Paris');
        }
    }
}
