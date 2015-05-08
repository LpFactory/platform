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
 * Load all services with tag : lp_factory.block.data_provider
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler
 * @author jobou
 */
class BlockDataProviderPass extends AbstractAliasCompilerPass
{
    /**
     * Get chain id
     *
     * @return string
     */
    protected function getChainId()
    {
        return 'lp_factory.block.data_provider.chain';
    }

    /**
     * Get tag
     *
     * @return string
     */
    protected function getTag()
    {
        return 'lp_factory.block.data_provider';
    }

    /**
     * Get method
     *
     * @return string
     */
    protected function getMethod()
    {
        return 'addProvider';
    }
}
