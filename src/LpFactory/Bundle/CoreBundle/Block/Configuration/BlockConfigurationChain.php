<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Configuration;

use LpFactory\Bundle\CoreBundle\Configuration\AbstractChain;

/**
 * Class BlockConfigurationChain
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
class BlockConfigurationChain extends AbstractChain implements BlockConfigurationChainInterface
{
    /**
     * {@inheritdoc}
     */
    public function addConfiguration(BlockConfigurationInterface $configuration, $alias)
    {
        return $this->addItem($configuration, $alias);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration($alias)
    {
        return $this->getItem($alias);
    }
}
