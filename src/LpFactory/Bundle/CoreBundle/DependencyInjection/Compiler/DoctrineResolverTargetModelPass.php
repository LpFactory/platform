<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * Class DoctrineResolverTargetModelPass
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler
 * @author jobou
 */
class DoctrineResolverTargetModelPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        foreach ($this->getParametersMapping() as $interface => $parameterName) {
            $definition->addMethodCall(
                'addResolveTargetEntity',
                array(
                    $interface,
                    new Parameter($parameterName),
                    array()
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getParametersMapping()
    {
        return array(
            'LpFactory\Bundle\CoreBundle\Model\AbstractBlock' => 'lpfactory.entity.block.class',
            'LpFactory\Bundle\CoreBundle\Model\AbstractPage'  => 'lpfactory.entity.page.class'
        );
    }
}
