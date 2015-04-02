<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Strategy;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface BlockPositionStrategyInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Strategy
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
