<?php
/**
 * File containing the RichText class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

namespace eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\Parser\FieldType;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\AbstractParser;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Configuration parser handling RichText field type related config
 */
class RichText extends AbstractParser
{
    /**
     * Adds semantic configuration definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\NodeBuilder $nodeBuilder Node just under ezpublish.system.<siteaccess>
     *
     * @return void
     */
    public function addSemanticConfig( NodeBuilder $nodeBuilder )
    {
        $nodeBuilder
            ->arrayNode( 'fieldtypes' )
                ->children()
                    ->arrayNode( 'ezrichtext' )
                        ->children()
                            ->arrayNode( 'output_custom_tags' )
                                ->info( 'Custom XSL stylesheets to use for RichText transformation to HTML5. Useful for "custom tags".' )
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
                            ->arrayNode( 'edit_custom_tags' )
                                ->info( 'Custom XSL stylesheets to use for RichText transformation to HTML5. Useful for "custom tags".' )
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
                            ->arrayNode( 'input_custom_tags' )
                                ->info( 'Custom XSL stylesheets to use for RichText transformation to HTML5. Useful for "custom tags".' )
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
                            ->arrayNode( 'tags' )
                                ->info( 'RichText template tags configuration.' )
                                ->useAttributeAsKey( 'key' )
                                ->normalizeKeys( false )
                                ->prototype( 'array' )
                                    ->info(
                                        "Name of RichText template tag.\n" .
                                        "'default' and 'default_inline' tag names are reserved for fallback."
                                    )
                                    ->example( "math_equation" )
                                    ->children()
                                        ->scalarNode( 'template' )
                                            ->info( 'Template to use for rendering RichText template tag.' )
                                            ->example( 'MyBundle:FieldType/RichText/tag:math_equation.html.twig' )
                                            ->isRequired()
                                            ->cannotBeEmpty()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode( 'embed' )
                                ->info( 'RichText embed tags configuration.' )
                                ->children()
                                    ->arrayNode( 'content' )
                                        ->info( 'Configuration for RichText block-level Content embed tags.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:content.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode( 'content_denied' )
                                        ->info( 'Configuration for RichText block-level Content embed tags when embed is not permitted.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:content_denied.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode( 'content_inline' )
                                        ->info( 'Configuration for RichText inline-level Content embed tags.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:content_inline.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode( 'content_inline_denied' )
                                        ->info( 'Configuration for RichText inline-level Content embed tags when embed is not permitted.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:content_inline_denied.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode( 'location' )
                                        ->info( 'Configuration for RichText block-level Location embed tags.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:location.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode( 'location_denied' )
                                        ->info( 'Configuration for RichText block-level Location embed tags when embed is not permitted.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:location_denied.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode( 'location_inline' )
                                        ->info( 'Configuration for RichText inline-level Location embed tags.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:location_inline.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode( 'location_inline_denied' )
                                        ->info( 'Configuration for RichText inline-level Location embed tags when embed is not permitted.' )
                                        ->children()
                                            ->scalarNode( 'template' )
                                                ->info( 'Default template to use for rendering RichText block-level embed tags.' )
                                                ->example( 'MyBundle:FieldType/RichText/embed:location_inline_denied.html.twig' )
                                                ->isRequired()
                                                ->cannotBeEmpty()
                                            ->end()
                                        ->end()
                                    ->end()
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

            if ( isset( $settings['fieldtypes']['ezrichtext']['output_custom_tags'] ) )
            {
                $settings['fieldtypes.ezrichtext.output_custom_xsl'] = $settings['fieldtypes']['ezrichtext']['output_custom_tags'];
                unset( $settings['fieldtypes']['ezrichtext']['output_custom_tags'] );
            }

            if ( isset( $settings['fieldtypes']['ezrichtext']['edit_custom_tags'] ) )
            {
                $settings['fieldtypes.ezrichtext.edit_custom_xsl'] = $settings['fieldtypes']['ezrichtext']['edit_custom_tags'];
                unset( $settings['fieldtypes']['ezrichtext']['edit_custom_tags'] );
            }

            if ( isset( $settings['fieldtypes']['ezrichtext']['input_custom_tags'] ) )
            {
                $settings['fieldtypes.ezrichtext.input_custom_xsl'] = $settings['fieldtypes']['ezrichtext']['input_custom_tags'];
                unset( $settings['fieldtypes']['ezrichtext']['input_custom_tags'] );
            }

            if ( isset( $settings['fieldtypes']['ezrichtext']['tags'] ) )
            {
                foreach ( $settings['fieldtypes']['ezrichtext']['tags'] as $name => $tagSettings )
                {
                    $reference = "fieldtypes.ezrichtext.tags.{$name}";
                    $settings[$reference] = $tagSettings;
                    unset( $settings['fieldtypes']['ezrichtext']['tags'][$name] );
                    $this->registerInternalConfigArray( $reference, $config, $container );
                }
            }

            if ( isset( $settings['fieldtypes']['ezrichtext']['embed'] ) )
            {
                foreach ( $settings['fieldtypes']['ezrichtext']['embed'] as $type => $embedSettings )
                {
                    $reference = "fieldtypes.ezrichtext.embed.{$type}";
                    $settings[$reference] = $embedSettings;
                    unset( $settings['fieldtypes']['ezrichtext']['tags'][$type] );
                    $this->registerInternalConfigArray( $reference, $config, $container );
                }
            }
        }

        $this->registerInternalConfigArray( 'fieldtypes.ezrichtext.output_custom_xsl', $config, $container );
        $this->registerInternalConfigArray( 'fieldtypes.ezrichtext.edit_custom_xsl', $config, $container );
        $this->registerInternalConfigArray( 'fieldtypes.ezrichtext.input_custom_xsl', $config, $container );
    }
}
