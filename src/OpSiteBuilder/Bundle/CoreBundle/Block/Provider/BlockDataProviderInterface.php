<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Provider;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockManagerInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
 * @author jobou
 */
interface BlockDataProviderInterface
{
    /**
     * Get data for a block
     *
     * @param \OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock $block
     *
     * @return mixed
     */
    public function getData(AbstractBlock $block);
}
