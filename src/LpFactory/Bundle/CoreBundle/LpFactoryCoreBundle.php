<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler\BlockConfigurationPass;
use LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler\BlockDataProviderPass;
use LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler\UrlSatinizerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class LpFactoryCoreBundle
 *
 * @package LpFactory\Bundle\CoreBundle
 * @author jobou
 */
class LpFactoryCoreBundle extends Bundle
{
    /**
     * @{inheritdoc}
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $modelDir = realpath($this->getPath() . '/Resources/config/model');

        $mappings = array(
            $modelDir => 'LpFactory\Bundle\CoreBundle\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings
            )
        );

        $container->addCompilerPass(new BlockDataProviderPass());
        $container->addCompilerPass(new BlockConfigurationPass());
        $container->addCompilerPass(new UrlSatinizerPass());
    }
}
