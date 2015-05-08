<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler;

/**
 * Class BlockConfigurationPass
 * Load all services with tag : lp_factory.block.configuration
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler
 * @author jobou
 */
class BlockConfigurationPass extends AbstractAliasCompilerPass
{
    /**
     * Get chain id
     *
     * @return string
     */
    protected function getChainId()
    {
        return 'lp_factory.block.configuration.chain';
    }

    /**
     * Get tag
     *
     * @return string
     */
    protected function getTag()
    {
        return 'lp_factory.block.configuration';
    }

    /**
     * Get method
     *
     * @return string
     */
    protected function getMethod()
    {
        return 'addConfiguration';
    }
}
