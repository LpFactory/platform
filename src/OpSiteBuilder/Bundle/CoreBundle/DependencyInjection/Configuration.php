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
                    ->children()
                        ->scalarNode('page_view_route_prefix')
                            ->defaultValue('opsite_page_tree_view_')
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
