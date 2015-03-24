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
 * Interface BlockManagerInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
 * @author jobou
 */
interface BlockManagerInterface
{
    /**
     * Check if block is empty
     *
     * @param AbstractBlock $block
     *
     * @return bool
     */
    public function isEmpty(AbstractBlock $block);

    /**
     * Get data of block
     *
     * @param AbstractBlock $block
     *
     * @return mixed
     */
    public function getData(AbstractBlock $block);
}
