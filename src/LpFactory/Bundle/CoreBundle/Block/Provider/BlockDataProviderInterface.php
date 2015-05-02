<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Provider;

use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockManagerInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block
 * @author jobou
 */
interface BlockDataProviderInterface
{
    /**
     * Get data for a block
     *
     * @param \LpFactory\Bundle\CoreBundle\Model\AbstractBlock $block
     *
     * @return mixed
     */
    public function getData(AbstractBlock $block);
}
