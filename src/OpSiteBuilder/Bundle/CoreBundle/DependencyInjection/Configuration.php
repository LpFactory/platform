<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\DependencyInjection
 * @author jobou
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('op_site_builder_core');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('routing')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('routes')
                            ->useAttributeAsKey('name')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('prefix')->isRequired()->end()
                                    ->scalarNode('controller')->isRequired()->end()
                                    ->scalarNode('regex')->defaultNull()->end()
                                    ->scalarNode('path')->defaultNull()->end()
                                ->end()
                            ->end()
                            ->defaultValue(array(
                                'edit' => array(
                                    'prefix' => 'opsite_page_tree_edit_',
                                    'regex' => '/(.+)\/edit$/',
                                    'controller' => 'OpSiteBuilderCoreBundle:Page:edit',
                                    'path' => '%s/edit'
                                ),
                                'view' => array(
                                    'prefix' => 'opsite_page_tree_view_',
                                    'regex' => null,
                                    'controller' => 'OpSiteBuilderCoreBundle:Page:index'
                                )
                            ))
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('page_map')
                    ->useAttributeAsKey('name')
                    ->defaultValue(array())
                    ->prototype('scalar')
                    ->end()
                ->end()
                ->arrayNode('block_map')
                    ->useAttributeAsKey('name')
                    ->defaultValue(array())
                    ->prototype('scalar')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
