<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class BlockManager
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
 * @author jobou
 */
class BlockManager implements BlockManagerInterface
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var array
     */
    protected $isEmpty = array();

    /**
     * @var BlockDataProviderChainInterface
     */
    protected $providerChain;

    /**
     * Constructor
     *
     * @param BlockDataProviderChainInterface $providerChain
     */
    public function __construct(BlockDataProviderChainInterface $providerChain)
    {
        $this->providerChain = $providerChain;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty(AbstractBlock $block)
    {
        if (isset($this->isEmpty[$block->getId()])) {
            return $this->isEmpty[$block->getId()];
        }

        $empty = $block->isEmpty();
        // If no empty state, use block manager
        if ($empty === null) {
            $data = $this->getData($block);
            $empty = empty($data);
        }

        return $this->isEmpty[$block->getId()] = $empty;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(AbstractBlock $block)
    {
        // Get data if not already done before
        if (!isset($this->data[$block->getId()])) {
            $provider = $this->providerChain->getProvider($block->getAlias());
            $this->data[$block->getId()] = $provider->getData($block);
        }

        // Return data
        return $this->data[$block->getId()];
    }
}
