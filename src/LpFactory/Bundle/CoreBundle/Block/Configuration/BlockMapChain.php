<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Configuration;

use LpFactory\Bundle\CoreBundle\Doctrine\EventListener\DoctrineDiscriminatorProviderInterface;

/**
 * Class BlockMapChain
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
class BlockMapChain implements BlockMapChainInterface, DoctrineDiscriminatorProviderInterface
{
    /**
     * @var array
     */
    protected $blockMap = array();

    /**
     * {@inheritdoc}
     */
    public function addMap(BlockMapInterface $map, $alias)
    {
        $this->blockMap[$alias] = $map;
    }

    /**
     * {@inheritdoc}
     */
    public function getMap($alias)
    {
        if (!isset($this->blockMap[$alias])) {
            throw new \LogicException('No block map '.$alias.' configured');
        }

        return $this->blockMap[$alias];
    }

    /**
     * Get the discriminator map for Doctrine class metadata
     *
     * @return array
     */
    public function getDiscriminatorMap()
    {
        $discriminatorMap = array();
        /** @var BlockMapInterface $map */
        foreach ($this->blockMap as $alias => $map) {
            $discriminatorMap[$alias] = $map->getClass();
        }

        return $discriminatorMap;
    }

    /**
     * Check if block map exists
     *
     * @param string $alias
     *
     * @return bool
     */
    public function has($alias)
    {
        return isset($this->blockMap[$alias]);
    }

    /**
     * Return all available types
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->blockMap);
    }

    /**
     * Return block maps
     *
     * @return array
     */
    public function all()
    {
        return $this->blockMap;
    }
}
