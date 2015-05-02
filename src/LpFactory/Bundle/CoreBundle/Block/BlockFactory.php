<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface;
use LpFactory\Bundle\CoreBundle\Block\Exception\UnknownBlockTypeException;

/**
 * Class BlockFactory
 *
 * @package LpFactory\Bundle\CoreBundle\Block
 * @author jobou
 */
class BlockFactory implements BlockFactoryInterface
{
    /**
     * @var BlockMapChainInterface
     */
    protected $blockMap;

    /**
     * Constructor
     *
     * @param BlockMapChainInterface $blockMap
     */
    public function __construct(BlockMapChainInterface $blockMap)
    {
        $this->blockMap = $blockMap;
    }

    /**
     * {@inheritdoc}
     */
    public function create($type)
    {
        if (!$this->blockMap->has($type)) {
            throw new UnknownBlockTypeException('Block type '.$type.' does not exists.');
        }

        $blockClass = $this->blockMap->getMap($type)->getClass();
        return new $blockClass();
    }
}
