<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class BlockDataProviderPass
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler
 * @author jobou
 */
class BlockDataProviderPass implements CompilerPassInterface
{
    /**
     * Load all services with tag : lp_factory.block.data_provider
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('lp_factory.block.data_provider.chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'lp_factory.block.data_provider.chain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'lp_factory.block.data_provider'
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
