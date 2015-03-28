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
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class OpSiteBuilderCoreExtension
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\DependencyInjection
 * @author jobou
 */
class OpSiteBuilderCoreExtension extends Extension
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
        $loader->load('entities.yml');
        $loader->load('doctrine.yml');
        $loader->load('repositories.yml');
        $loader->load('cmf_routing.yml');
        $loader->load('managers.yml');
        $loader->load('security.yml');
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
        $routeConfigurationChain = $container->findDefinition('opsite_builder.route_configuration.chain');
        foreach ($config['routing']['routes'] as $alias => $routeConfiguration) {
            $routeConfigurationChain->addMethodCall('add', array($alias, $routeConfiguration));
        }

        $pageDiscriminatorListener = $container->findDefinition('doctrine.event_listener.page.discriminator_map');
        $pageDiscriminatorListener->replaceArgument(1, $config['page_map']);

        $blockDiscriminatorListener = $container->findDefinition('doctrine.event_listener.block.discriminator_map');
        $blockDiscriminatorListener->replaceArgument(1, $config['block_map']);
    }
}
