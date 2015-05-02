<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Provider;

/**
 * Interface BlockDataProviderChainInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block
 * @author jobou
 */
interface BlockDataProviderChainInterface
{
    /**
     * Add a provider to the chain
     *
     * @param BlockDataProviderInterface $provider
     * @param string                     $alias
     *
     * @return $this
     */
    public function addProvider(BlockDataProviderInterface $provider, $alias);

    /**
     * Get a provider for a block alias
     * Fallback to a default one if none found (no exception)
     *
     * @param string $alias
     *
     * @return BlockDataProviderInterface
     */
    public function getProvider($alias);
}
