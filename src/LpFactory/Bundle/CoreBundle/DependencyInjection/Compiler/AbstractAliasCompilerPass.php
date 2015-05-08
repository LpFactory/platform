<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AbstractAliasCompilerPass
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler
 * @author jobou
 */
abstract class AbstractAliasCompilerPass implements CompilerPassInterface
{
    /**
     * Load services
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->getChainId())) {
            return;
        }

        $definition = $container->getDefinition($this->getChainId());

        $taggedServices = $container->findTaggedServiceIds($this->getTag());
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    $this->getMethod(),
                    array(new Reference($id), $attributes["alias"])
                );
            }
        }
    }

    /**
     * Get chain id
     *
     * @return string
     */
    abstract protected function getChainId();

    /**
     * Get tag
     *
     * @return string
     */
    abstract protected function getTag();

    /**
     * Get method
     *
     * @return string
     */
    abstract protected function getMethod();
}
