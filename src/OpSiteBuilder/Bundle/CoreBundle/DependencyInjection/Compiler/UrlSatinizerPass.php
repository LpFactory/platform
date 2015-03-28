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
 * Class UrlSatinizerPass
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\DependencyInjection\Compiler
 * @author jobou
 */
class UrlSatinizerPass implements CompilerPassInterface
{
    /**
     * Load all services with tag : opsite_builder.routing.satinizer
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('opsite_builder.routing.satinizer.chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'opsite_builder.routing.satinizer.chain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'opsite_builder.routing.satinizer'
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addSatinizer',
                array(new Reference($id))
            );
        }
    }
}
