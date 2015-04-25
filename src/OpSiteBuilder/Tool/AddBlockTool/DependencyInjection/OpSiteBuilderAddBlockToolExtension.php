<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Tool\AddBlockTool\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class OpSiteBuilderCoreExtension
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\DependencyInjection
 * @author jobou
 */
class OpSiteBuilderAddBlockToolExtension extends Extension implements PrependExtensionInterface
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
        $loader->load('tools.yml');
    }

    /**
     * Prepend some configuration to container to enable the tool automatically
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        // Tool add block configuration
        $container->prependExtensionConfig(
            'op_site_builder_core',
            array(
                'tools' => array(
                    'add_block' => array(
                        'priority' => 10
                    )
                )
            )
        );
    }
}
