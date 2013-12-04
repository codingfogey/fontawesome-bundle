<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('codingfogey_font_awesome');

        $rootNode
            ->children()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.root_dir%/../vendor/fortawesome/font-awesome')
                ->end()
                ->arrayNode('customize')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('variables_file')
                        ->defaultValue('%kernel.root_dir%/Resources/fontawesome/variables.less')
                        ->end()
                        ->scalarNode('font_awesome_output')
                        ->defaultValue('%kernel.root_dir%/Resources/less/fontawesome.less')
                        ->end()
                        ->scalarNode('font_awesome_template')
                        ->defaultValue('CodingfogeyFontAwesomeBundle:FontAwesome:fontawesome.less.twig')
                        ->end()
                    ->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
