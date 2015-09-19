<?php

namespace Colin\Bundle\TimezoneBundle\DependencyInjection;

use Colin\Bundle\TimezoneBundle\Timezone\StaticDetector;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ColinTimezoneExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $viewTimezone = $config['view_timezone'];
        $detectors = [];

        foreach ($viewTimezone as $timezone) {
            if (in_array($timezone, \DateTimeZone::listIdentifiers())) {
                $detectors[] = new StaticDetector($timezone);
            } elseif ($container->has($timezone)) {
                $detectors[] = new Reference($timezone);
            } else {
                throw new \RuntimeException(sprintf('Unable to handle "%s" timezone', $timezone));
            }
        }

        $chain = $container->getDefinition('colin_timezone.detector.chain');
        $chain->replaceArgument(0, []);
    }
}
