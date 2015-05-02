<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Strategy;

use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface BlockPositionStrategyInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Strategy
 * @author jobou
 */
interface BlockPositionStrategyInterface
{
    /**
     * Get the position of the new block in the page
     *
     * @param AbstractBlock $block
     * @param AbstractPage  $page
     *
     * @return int
     */
    public function getPosition(AbstractBlock $block, AbstractPage $page);
}
