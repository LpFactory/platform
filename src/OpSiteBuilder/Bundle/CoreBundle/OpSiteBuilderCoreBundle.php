<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use OpSiteBuilder\Bundle\CoreBundle\DependencyInjection\Compiler\BlockConfigurationPass;
use OpSiteBuilder\Bundle\CoreBundle\DependencyInjection\Compiler\BlockDataProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OpSiteBuilderCoreBundle
 *
 * @package OpSiteBuilder\Bundle\CoreBundle
 * @author jobou
 */
class OpSiteBuilderCoreBundle extends Bundle
{
    /**
     * @{inheritdoc}
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $modelDir = realpath(__DIR__ . '/Resources/config/model');

        $mappings = array(
            $modelDir => 'OpSiteBuilder\Bundle\CoreBundle\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings
            )
        );

        $container->addCompilerPass(new BlockDataProviderPass());
        $container->addCompilerPass(new BlockConfigurationPass());
    }
}
