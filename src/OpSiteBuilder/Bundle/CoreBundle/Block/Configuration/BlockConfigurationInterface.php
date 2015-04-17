<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Configuration;

/**
 * Interface BlockConfigurationInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
interface BlockConfigurationInterface
{
    /**
     * Get the view controller for a block
     *
     * @return string
     */
    public function getViewController();

    /**
     * Get the view route for a block
     *
     * @return string
     */
    public function getViewRoute();

    /**
     * Get the route for this block edition
     *
     * @return string
     */
    public function getEditRoute();
}
