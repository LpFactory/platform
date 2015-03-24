<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Provider;

use OpSiteBuilder\Bundle\CoreBundle\Block\BlockDataProviderInterface;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class DefaultDataProvider
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Provider
 * @author jobou
 */
class DefaultDataProvider implements BlockDataProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getData(AbstractBlock $block)
    {
        return array();
    }
}
