<?php
/**
 * File containing the XmlTextTest class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

namespace eZ\Bundle\EzPublishCoreBundle\Tests\DependencyInjection\Configuration\Parser\FieldType;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\EzPublishCoreExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\Parser\FieldType\XmlText as XmlTextConfigParser;
use Symfony\Component\Yaml\Yaml;

class XmlTextTest extends AbstractExtensionTestCase
{
    /**
     * Return an array of container extensions you need to be registered for each test (usually just the container
     * extension you are testing.
     *
     * @return ExtensionInterface[]
     */
    protected function getContainerExtensions()
    {
        return array(
            new EzPublishCoreExtension( array( new XmlTextConfigParser ) )
        );
    }

    protected function getMinimalConfiguration()
    {
        return Yaml::parse( __DIR__ . '/../../../Fixtures/ezpublish_minimal.yml' );
    }

    /**
     * @dataProvider contentSettingsProvider
     */
    public function testContentSettings( array $config, array $expected )
    {
        $this->load(
            array(
                'system' => array(
                    'ezdemo_site' => $config
                )
            )
        );

        foreach ( $expected as $key => $val )
        {
            $this->assertSame( $val, $this->container->getParameter( $key ) );
        }
    }

    public function contentSettingsProvider()
    {
        return array(
            array(
                array(
                    'fieldtypes' => array(
                        'ezxml' => array(
                            'custom_tags' => array(
                                array( 'path' => '/foo/bar.xsl', 'priority' => 123 ),
                                array( 'path' => '/foo/custom.xsl', 'priority' => -10 ),
                                array( 'path' => '/another/custom.xsl', 'priority' => 27 ),
                            )
                        )
                    )
                ),
                array(
                    'ezsettings.ezdemo_site.fieldtypes.ezxml.custom_xsl' => array(
                        // Default settings will be added
                        array( 'path' => '%kernel.root_dir%/../vendor/ezsystems/ezpublish-kernel/eZ/Publish/Core/FieldType/XmlText/Input/Resources/stylesheets/eZXml2Html5_core.xsl', 'priority' => 0 ),
                        array( 'path' => '%kernel.root_dir%/../vendor/ezsystems/ezpublish-kernel/eZ/Publish/Core/FieldType/XmlText/Input/Resources/stylesheets/eZXml2Html5_custom.xsl', 'priority' => 0 ),
                        array( 'path' => '/foo/bar.xsl', 'priority' => 123 ),
                        array( 'path' => '/foo/custom.xsl', 'priority' => -10 ),
                        array( 'path' => '/another/custom.xsl', 'priority' => 27 ),
                    ),
                )
            ),
        );
    }
}
