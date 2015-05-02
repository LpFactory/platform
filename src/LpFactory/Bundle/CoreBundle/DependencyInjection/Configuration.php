<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection
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
        $rootNode = $treeBuilder->root('lp_factory_core');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('page_map')
                    ->useAttributeAsKey('name')
                    ->defaultValue(array())
                    ->prototype('scalar')
                    ->end()
                ->end()
                ->append($this->addBlockMapNode())
                ->append($this->addRoutingNode())
                ->append($this->addBlockConfigurationNode())
                ->append($this->addToolsNode())
            ->end();

        return $treeBuilder;
    }

    /**
     * Configure block_map node
     *
     * @return ArrayNodeDefinition|NodeDefinition
     */
    protected function addBlockMapNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('block_map');

        $node
            ->defaultValue(array())
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->scalarNode('class')->isRequired()->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    /**
     * Configure routing node
     *
     * @return ArrayNodeDefinition|NodeDefinition
     */
    protected function addRoutingNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('routing');

        $node
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
                            'prefix' => 'lpfactory_page_tree_edit_',
                            'regex' => '/(.+)\/edit$/',
                            'controller' => 'LpFactoryCoreBundle:Page:edit',
                            'path' => '%s/edit'
                        ),
                        'view' => array(
                            'prefix' => 'lpfactory_page_tree_view_',
                            'regex' => null,
                            'controller' => 'LpFactoryCoreBundle:Page:index'
                        )
                    ))
                ->end()
            ->end()
        ;

        return $node;
    }

    /**
     * Configure block_configuration node
     *
     * @return ArrayNodeDefinition|NodeDefinition
     */
    protected function addBlockConfigurationNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('block_configuration');

        $node
            ->useAttributeAsKey('name')
            ->defaultValue(array())
            ->prototype('array')
                ->children()
                    ->scalarNode('view_template')
                        ->defaultValue('LpFactoryWebBundle:Block:View/default_view.html.twig')
                    ->end()
                    ->scalarNode('view_controller')
                        ->defaultValue('LpFactoryCoreBundle:Block:default')
                    ->end()
                    ->scalarNode('view_route')
                        ->defaultValue('lp_factory_api_view_block')
                    ->end()
                    ->scalarNode('edit_controller')
                        ->defaultValue('LpFactoryCoreBundle:Block:defaultEdit')
                    ->end()
                    ->scalarNode('edit_route')
                        ->defaultValue('lp_factory_api_edit_no_form_block')
                    ->end()
                    ->scalarNode('edit_template')
                        ->defaultValue('LpFactoryWebBundle:Block:View/default_edit.html.twig')
                    ->end()
                    ->scalarNode('edit_form_type')
                        ->defaultNull()
                    ->end()
                    ->arrayNode('options')
                        ->validate()
                            ->ifTrue(function ($v) {
                                return !is_array($v);
                            })
                            ->thenInvalid('Options for block configuration should always be an array')
                        ->end()
                        ->defaultValue(array())
                        ->prototype('variable')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    /**
     * Configure tools node
     *
     * @return ArrayNodeDefinition|NodeDefinition
     */
    protected function addToolsNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('tools');

        $node
            ->useAttributeAsKey('name')
            ->defaultValue(array())
            ->prototype('array')
                ->children()
                    ->scalarNode('directive')
                        ->isRequired()
                    ->end()
                    ->arrayNode('directive_attributes')
                        ->validate()
                            ->ifTrue(function ($v) {
                                if (!is_array($v)) {
                                    return true;
                                }

                                foreach ($v as $key => $item) {
                                    if (!is_scalar($item)) {
                                        return true;
                                    }
                                }

                                return false;
                            })
                            ->thenInvalid('Directive attributs should be array and contains only scalar value.')
                        ->end()
                        ->defaultValue(array())
                        ->prototype('variable')
                        ->end()
                    ->end()
                    ->booleanNode('enabled')
                        ->defaultTrue()
                    ->end()
                    ->arrayNode('pages')
                        ->defaultValue(array())
                        ->prototype('scalar')
                        ->end()
                    ->end()
                    ->integerNode('priority')
                        ->defaultValue(100)
                    ->end()
                    ->arrayNode('post_normalizers')
                        ->defaultValue(array())
                        ->prototype('scalar')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }
}
