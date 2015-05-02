<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class LpFactoryCoreExtension
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection
 * @author jobou
 */
class LpFactoryCoreExtension extends Extension implements PrependExtensionInterface
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
        $routeConfigurationChain = $container->findDefinition('lp_factory.route_configuration.chain');
        foreach ($config['routing']['routes'] as $alias => $routeConfiguration) {
            $routeConfigurationChain->addMethodCall('add', array($alias, $routeConfiguration));
        }

        // Save page map in service used by the doctrine event
        $pageDiscriminatorMap = $container->findDefinition('lp_factory.page.map');
        $pageDiscriminatorMap->replaceArgument(0, $config['page_map']);

        // Load block configuration and addConfiguration to block configuration chain
        $this->loadBlockConfiguration($config, $container);

        // Load block map and addMap to block map chain
        $this->loadBlockMap($config, $container);

        // Load tools, post normalizer for page  and addTool to tools chain
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
                'lp_factory.block.configuration.chain',
                $config['block_configuration'],
                'lp_factory.block.configuration.default.class',
                'lp_factory.block.configuration.',
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
                'lp_factory.block.map.chain',
                $config['block_map'],
                'lp_factory.block.map.default.class',
                'lp_factory.block.map.',
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
        $pageNormalizerDefinition = $container->findDefinition('lp_factory.page.normalizer');
        foreach ($config['tools'] as $alias => $tool) {
            foreach ($tool['post_normalizers'] as $normalizer) {
                $pageNormalizerDefinition->addMethodCall('addToolNormalizer', array(new Reference($normalizer)));
            }
            unset($config['tools'][$alias]['post_normalizers']);
        }

        $this
            ->loadChainedServices(
                $container,
                'lp_factory.tools.chain',
                $config['tools'],
                'lp_factory.tool.default.class',
                'lp_factory.tool.',
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
        $container->prependExtensionConfig('assetic', array('bundles' => array('LpFactoryWebBundle')));

        // Block prepend default configuration
        $container->prependExtensionConfig(
            'lp_factory_core',
            array(
                'block_configuration' => array(
                    'default' => array(
                        'view_template'   => 'LpFactoryWebBundle:Block:View/default_view.html.twig',
                        'view_controller' => 'LpFactoryCoreBundle:Block:default',
                        'view_route'      => 'lp_factory_api_view_block',
                        'edit_controller' => 'LpFactoryCoreBundle:Block:defaultEdit',
                        'edit_route'      => 'lp_factory_api_edit_no_form_block',
                        'edit_template'   => 'LpFactoryWebBundle:Block:View/default_edit.html.twig',
                        'edit_form_type'  => null,
                        'options'         => array()
                    )
                )
            )
        );

        // Tool add block configuration
        $container->prependExtensionConfig(
            'lp_factory_core',
            array(
                'tools' => array(
                    'add_block' => array(
                        'directive' => 'lpfactory-tool-add-block',
                        'directive_attributes' => array(
                            'template' => '/bundles/lpfactoryweb/html/tool_add_block.html'
                        ),
                        'priority' => 10,
                        'post_normalizers' => array(
                            'lp_factory.page.post_normalizer.add_block'
                        )
                    )
                )
            )
        );
    }
}
