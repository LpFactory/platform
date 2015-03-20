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
            ->children()
                ->arrayNode('routing')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('route_name_prefix')
                            ->defaultValue('opsite_page_tree_')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
