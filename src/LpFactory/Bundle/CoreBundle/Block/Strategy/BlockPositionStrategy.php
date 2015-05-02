<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Strategy;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class BlockPositionStrategy
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Strategy
 * @author jobou
 */
class BlockPositionStrategy implements BlockPositionStrategyInterface
{
    /**
     * Get the position of the new block in the page
     *
     * @param AbstractBlock $block
     * @param AbstractPage  $page
     *
     * @return int
     */
    public function getPosition(AbstractBlock $block, AbstractPage $page)
    {
        /** @var AbstractBlock $lastBlock */
        $lastBlock = $page->getBlocks()->last();
        if (!$lastBlock) {
            return 1;
        }

        return 1 + ((int) $lastBlock->getSort());
    }
}
