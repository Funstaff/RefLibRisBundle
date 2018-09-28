<?php

namespace Funstaff\RefLibRisBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * RefLibRisExtension
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RefLibRisExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        /* Classes */
        $container->setParameter('ref_lib_ris.ris_mappings.class', $config['classes']['ris_mappings']);
        $container->setParameter('ref_lib_ris.record_processing.class', $config['classes']['record_processing']);
        $container->setParameter('ref_lib_ris.ris_definition.class', $config['classes']['ris_definition']);
        $container->setParameter('ref_lib_ris.ris_writer.class', $config['classes']['ris_writer']);

        $container->setParameter('ref_lib_ris.fallback', $config['fallback']);
        $container->setParameter('ref_lib_ris.mappings', $config['mappings']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}
