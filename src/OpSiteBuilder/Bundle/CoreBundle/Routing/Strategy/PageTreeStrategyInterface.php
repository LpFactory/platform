<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface PageTreeStrategyInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy
 * @author jobou
 */
interface PageTreeStrategyInterface
{
    /**
     * Get the root node of a tree according to hostname
     * Used for multi tree strategy (one per hostname)
     *
     * @param string $hostName
     *
     * @return AbstractPage
     */
    public function getRootNode($hostName);
}
