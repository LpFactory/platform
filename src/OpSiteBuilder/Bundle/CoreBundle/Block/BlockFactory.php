<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface;
use OpSiteBuilder\Bundle\CoreBundle\Block\Exception\UnknownBlockTypeException;

/**
 * Class BlockFactory
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
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
