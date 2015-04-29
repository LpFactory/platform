<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Provider;

use OpSiteBuilder\Bundle\CoreBundle\Configuration\AbstractChain;

/**
 * Class BlockDataProviderChain
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
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
