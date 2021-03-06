<?php

namespace Funstaff\RefLibRisBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ref_lib_ris');

        $rootNode
            ->children()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('ris_mappings')->defaultValue('Funstaff\RefLibRis\RisMappings')->end()
                        ->scalarNode('record_processing')->defaultValue('Funstaff\RefLibRis\RecordProcessing')->end()
                        ->scalarNode('ris_definition')->defaultValue('Funstaff\RefLibRis\RisDefinition')->end()
                        ->scalarNode('ris_writer')->defaultValue('Funstaff\RefLibRis\RisWriter')->end()
                    ->end()
                ->end()
                ->scalarNode('fallback')->isRequired()->end()
                ->arrayNode('mappings')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->requiresAtLeastOneElement()
                        ->prototype('array')
                            ->useAttributeAsKey('name')
                            ->prototype('scalar')->end()
                        ->end()
                        ->validate()
                        ->ifTrue(function($v) {
                            return !array_key_exists('TY', $v);
                        })
                        ->thenInvalid('TY field is mandatory')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
