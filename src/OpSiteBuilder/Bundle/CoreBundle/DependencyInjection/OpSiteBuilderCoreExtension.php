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

        // Update doctrine discriminator map for page entity
        $pageDiscriminatorListener = $container->findDefinition('doctrine.event_listener.page.discriminator_map');
        $pageDiscriminatorListener->replaceArgument(1, $config['page_map']);

        // Update doctrine discriminator map for block entity
        $container->setParameter('opsite_builder.block.class_map', $config['block_map']);
        $blockDiscriminatorListener = $container->findDefinition('doctrine.event_listener.block.discriminator_map');
        $blockDiscriminatorListener->replaceArgument(1, $config['block_map']);

        // Load block configuration and addConfiguration to block configuration chain
        $this->loadBlockConfiguration($config, $container);

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
        $definitionBlockConfigurationChain = $container->getDefinition('opsite_builder.block.configuration.chain');
        foreach ($config['block_configuration'] as $blockAlias => $blockConfig) {
            $blockConfigurationItem = new Definition(
                $container->getParameter('opsite_builder.block.configuration.default.class'),
                array($blockConfig)
            );

            $definitionKey = 'opsite_builder.block.configuration.'.$blockAlias;
            $container->setDefinition($definitionKey, $blockConfigurationItem);

            $definitionBlockConfigurationChain
                ->addMethodCall('addConfiguration', array($blockConfigurationItem, $blockAlias));
        }
    }

    /**
     * Load tools and addTool to tools chain
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function loadTools(array $config, ContainerBuilder $container)
    {
        $definitionToolsChain = $container->getDefinition('opsite_builder.tools.chain');
        foreach ($config['tools'] as $toolAlias => $toolConfig) {
            $toolItem = new Definition(
                $container->getParameter('opsite_builder.tool.default.class'),
                array($toolConfig)
            );

            $definitionKey = 'opsite_builder.tool.'.$toolAlias;
            $container->setDefinition($definitionKey, $toolItem);

            $definitionToolsChain
                ->addMethodCall('addTool', array($toolItem, $toolAlias));
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
    }
}
