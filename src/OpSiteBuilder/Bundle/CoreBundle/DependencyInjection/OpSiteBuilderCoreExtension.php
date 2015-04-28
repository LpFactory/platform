<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Validator\Tests\Fixtures\Reference;

/**
 * Class OpSiteBuilderCoreExtension
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\DependencyInjection
 * @author jobou
 */
class OpSiteBuilderCoreExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('blocks.yml');
        $loader->load('cmf_routing.yml');
        $loader->load('doctrine.yml');
        $loader->load('entities.yml');
        $loader->load('pages.yml');
        $loader->load('repositories.yml');
        $loader->load('security.yml');
        $loader->load('serializer.yml');
        $loader->load('tools.yml');
        $loader->load('twig.yml');

        $config = $this->processConfiguration(new Configuration(), $configs);
        $this->loadConfiguration($config, $container);
    }

    /**
     * Load configuration in container
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function loadConfiguration(array $config, ContainerBuilder $container)
    {
        // Load page nested routes
        $routeConfigurationChain = $container->findDefinition('opsite_builder.route_configuration.chain');
        foreach ($config['routing']['routes'] as $alias => $routeConfiguration) {
            $routeConfigurationChain->addMethodCall('add', array($alias, $routeConfiguration));
        }

        // Save page map in service used by the doctrine event
        $pageDiscriminatorMap = $container->findDefinition('opsite_builder.page.map');
        $pageDiscriminatorMap->replaceArgument(0, $config['page_map']);

        // Load block configuration and addConfiguration to block configuration chain
        $this->loadBlockConfiguration($config, $container);

        // Load block map and addMap to block map chain
        $this->loadBlockMap($config, $container);

        // Load tools and addTool to tools chain
        $this->loadTools($config, $container);
    }

    /**
     * Load block configuration and addConfiguration to block configuration chain
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function loadBlockConfiguration(array $config, ContainerBuilder $container)
    {
        $this
            ->loadChainedServices(
                $container,
                'opsite_builder.block.configuration.chain',
                $config['block_configuration'],
                'opsite_builder.block.configuration.default.class',
                'opsite_builder.block.configuration.',
                'addConfiguration'
            );
    }

    /**
     * Load block map and addMap to block map chain
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function loadBlockMap(array $config, ContainerBuilder $container)
    {
        $this
            ->loadChainedServices(
                $container,
                'opsite_builder.block.map.chain',
                $config['block_map'],
                'opsite_builder.block.map.default.class',
                'opsite_builder.block.map.',
                'addMap'
            );
    }

    /**
     * Load tools and addTool to tools chain
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function loadTools(array $config, ContainerBuilder $container)
    {
        $this
            ->loadChainedServices(
                $container,
                'opsite_builder.tools.chain',
                $config['tools'],
                'opsite_builder.tool.default.class',
                'opsite_builder.tool.',
                'addTool'
            );
    }

    /**
     * Generic method to manage loading services in chain service
     *
     * @param ContainerBuilder $container
     * @param string           $chainDefinition
     * @param array            $items
     * @param string           $itemClassParameter
     * @param string           $itemDefinitionPrefix
     * @param string           $addMethodCall
     */
    protected function loadChainedServices(
        ContainerBuilder $container,
        $chainDefinition,
        $items,
        $itemClassParameter,
        $itemDefinitionPrefix,
        $addMethodCall
    ) {
        $definitionChain = $container->getDefinition($chainDefinition);
        foreach ($items as $alias => $item) {
            $itemDefinition = new Definition(
                $container->getParameter($itemClassParameter),
                array($item)
            );

            // Add a service definition for each item
            $definitionKey = $itemDefinitionPrefix.$alias;
            $container->setDefinition($definitionKey, $itemDefinition);

            // Load the service in the chain
            $definitionChain
                ->addMethodCall($addMethodCall, array($itemDefinition, $alias));
        }
    }

    /**
     * Prepend some configuration to container
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        // Bundle use serializer
        $container->prependExtensionConfig('framework', array('serializer' => array('enabled' => true)));

        // Bundle needs assetic
        $container->prependExtensionConfig('assetic', array('bundles' => array('OpSiteBuilderWebBundle')));

        // Block prepend default configuration
        $container->prependExtensionConfig(
            'op_site_builder_core',
            array(
                'block_configuration' => array(
                    'default' => array(
                        'view_template'   => 'OpSiteBuilderWebBundle:Block:View/default_view.html.twig',
                        'view_controller' => 'OpSiteBuilderCoreBundle:Block:default',
                        'view_route'      => 'opsite_builder_api_view_block',
                        'edit_controller' => 'OpSiteBuilderCoreBundle:Block:defaultEdit',
                        'edit_route'      => 'opsite_builder_api_edit_no_form_block',
                        'edit_template'   => 'OpSiteBuilderWebBundle:Block:View/default_edit.html.twig',
                        'edit_form_type'  => null,
                        'options'         => array()
                    )
                )
            )
        );

        // Tool add block configuration
        $container->prependExtensionConfig(
            'op_site_builder_core',
            array(
                'tools' => array(
                    'add_block' => array(
                        'directive' => 'opsite-tool-add-block',
                        'directive_attributes' => array(
                            'template' => '/bundles/opsitebuilderweb/html/tool_add_block.html'
                        ),
                        'priority' => 10
                    )
                )
            )
        );
    }
}
