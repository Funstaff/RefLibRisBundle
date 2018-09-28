<?php

namespace Funstaff\RefLibRisBundle\Tests\DependencyInjection;

use Funstaff\RefLibRisBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

/**
 * ConfigurationTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testNoConfiguration
     */
    public function testNoConfiguration()
    {
        $this->expectException(InvalidConfigurationException::class);
        $config = [];
        $processor = new Processor();
        $configuration = new Configuration();
        $processor->processConfiguration($configuration, $config);
    }

    /**
     * testDefaultClasses
     */
    public function testDefaultClasses()
    {
        $config = [[
            'fallback' => 'default',
            'mappings' => [
                'BOOK' => [
                    'TY' => ['BOOK'],
                ]
            ],
        ]];
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $config);

        $this->assertEquals('default', $config['fallback']);
        $this->assertEquals('Funstaff\RefLibRis\RisMappings', $config['classes']['ris_mappings']);
        $this->assertEquals('Funstaff\RefLibRis\RecordProcessing', $config['classes']['record_processing']);
        $this->assertEquals('Funstaff\RefLibRis\RisDefinition', $config['classes']['ris_definition']);
        $this->assertEquals('Funstaff\RefLibRis\RisWriter', $config['classes']['ris_writer']);
    }

    /**
     * testClasses
     */
    public function testClasses()
    {
        $config = [[
            'classes' => [
                'ris_mappings' => 'Funstaff\RefLibRis\FooBar',
            ],
            'fallback' => 'default',
            'mappings' => [
                'BOOK' => [
                    'TY' => ['BOOK'],
                ]
            ],
        ]];
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $config);

        $this->assertEquals('Funstaff\RefLibRis\FooBar', $config['classes']['ris_mappings']);
    }

    /**
     * testMappingWithMissingFieldTY
     */
    public function testMappingWithMissingFieldTY()
    {
        $this->expectException(InvalidConfigurationException::class);
        $config = [[
            'mappings' => [
                'BOOK' => [
                    'AU' => ['author'],
                ]
            ],
        ]];
        $processor = new Processor();
        $configuration = new Configuration();
        $processor->processConfiguration($configuration, $config);
    }

    /**
     * testMapping
     */
    public function testMapping()
    {
        $config = [[
            'fallback' => 'default',
            'mappings' => [
                'BOOK' => [
                    'TY' => ['BOOK'],
                    'AU' => ['author'],
                ]
            ],
        ]];
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $config);

        $this->assertEquals('default', $config['fallback']);
        $this->assertEquals(['BOOK' => ['TY' => ['BOOK'], 'AU' => ['author']]], $config['mappings']);
    }
}
