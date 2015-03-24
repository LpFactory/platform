<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class BlockDataProviderPass
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\DependencyInjection\Compiler
 * @author jobou
 */
class BlockDataProviderPass implements CompilerPassInterface
{
    /**
     * Load all services with tag : opsite_builder.block.data_provider
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('opsite_builder.block.data_provider.chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'opsite_builder.block.data_provider.chain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'opsite_builder.block.data_provider'
        );
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addProvider',
                    array(new Reference($id), $attributes["alias"])
                );
            }
        }
    }
}
