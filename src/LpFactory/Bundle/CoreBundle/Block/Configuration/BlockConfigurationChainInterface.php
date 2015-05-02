<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Configuration;

/**
 * Interface BlockConfigurationChainInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
interface BlockConfigurationChainInterface
{
    /**
     * Add a configuration to the chain
     *
     * @param array|BlockConfigurationInterface $configuration
     * @param string                            $alias
     *
     * @return $this
     */
    public function addConfiguration(BlockConfigurationInterface $configuration, $alias);

    /**
     * Get a configuration for a block alias
     * Fallback to a default one if none found (no exception)
     *
     * @param string $alias
     *
     * @return BlockConfigurationInterface
     */
    public function getConfiguration($alias);
}
