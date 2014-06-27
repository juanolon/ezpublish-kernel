<?php
/**
 * File containing the XmlText class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

namespace eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\Parser\FieldType;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\Parser\AbstractFieldTypeParser;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Configuration parser handling content related config
 */
class XmlText extends AbstractFieldTypeParser
{
    /**
     * Adds semantic configuration definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\NodeBuilder $nodeBuilder Node just under ezpublish.system.<siteaccess>.fieldtypes
     *
     * @return void
     */
    public function addSemanticConfig( NodeBuilder $nodeBuilder )
    {
        $nodeBuilder->setParent()
            ->arrayNode( 'ezxml' )
                ->children()
                    ->arrayNode( 'custom_tags' )
                        ->info( 'Custom XSL stylesheets to use for XmlText transformation to HTML5. Useful for "custom tags".' )
                        ->example(
                            array(
                                'path' => '%kernel.root_dir%/../src/Acme/TestBundle/Resources/myTag.xsl',
                                'priority' => 10
                            )
                        )
                        ->prototype( 'array' )
                            ->children()
                                ->scalarNode( 'path' )
                                    ->info( 'Path of the XSL stylesheet to load.' )
                                    ->isRequired()
                                ->end()
                                ->integerNode( 'priority' )
                                    ->info( 'Priority in the loading order. A high value will have higher precedence in overriding XSL templates.' )
                                    ->defaultValue( 0 )
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Translates parsed semantic config values from $config to internal key/value pairs.
     *
     * @param array $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return mixed
     */
    public function registerInternalConfig( array $config, ContainerBuilder $container )
    {
        foreach ( $config['system'] as $sa => &$settings )
        {
            // Workaround to be able to use registerInternalConfigArray() which only supports first level entries.
            if ( isset( $settings['fieldtypes']['ezxml']['custom_tags'] ) )
            {
                $settings['fieldtypes.ezxml.custom_xsl'] = $settings['fieldtypes']['ezxml']['custom_tags'];
                unset( $settings['fieldtypes']['ezxml']['custom_tags'] );
            }
        }

        $this->registerInternalConfigArray( 'fieldtypes.ezxml.custom_xsl', $config, $container );
    }
}
