<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block;

use Doctrine\Common\Persistence\ObjectManager;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;
use LpFactory\Bundle\CoreBundle\Block\Provider\BlockDataProviderChainInterface;

/**
 * Class BlockManager
 *
 * @package LpFactory\Bundle\CoreBundle\Block
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
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param BlockDataProviderChainInterface $providerChain
     * @param ObjectManager                   $manager
     */
    public function __construct(
        BlockDataProviderChainInterface $providerChain,
        ObjectManager $manager
    ) {
        $this->providerChain = $providerChain;
        $this->manager = $manager;
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

    /**
     * {@inheritdoc}
     */
    public function save(AbstractBlock $block, $flush = true)
    {
        $this->manager->persist($block);
        if ($flush) {
            $this->manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove(AbstractBlock $block, $flush = true)
    {
        $this->manager->remove($block);
        if ($flush) {
            $this->manager->flush();
        }
    }
}
