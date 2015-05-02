<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Provider;

use LpFactory\Bundle\CoreBundle\Configuration\AbstractChain;

/**
 * Class BlockDataProviderChain
 *
 * @package LpFactory\Bundle\CoreBundle\Block
 * @author jobou
 */
class BlockDataProviderChain extends AbstractChain implements BlockDataProviderChainInterface
{
    /**
     * {@inheritdoc}
     */
    public function addProvider(BlockDataProviderInterface $provider, $alias)
    {
        return $this->addItem($provider, $alias);
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider($alias)
    {
        return $this->getItem($alias);
    }
}
