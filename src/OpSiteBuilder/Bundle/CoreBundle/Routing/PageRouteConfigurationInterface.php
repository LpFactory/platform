<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing;

/**
 * Interface PageRouteConfigurationInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
interface PageRouteConfigurationInterface 
{
    /**
     * Get the prefix used in the route
     *
     * @return string
     */
    public function getRoutePrefix();

    /**
     * Get the request to be match with the request
     *
     * @return string|null
     */
    public function getMatchingRegex();

    /**
     * Get the controller to execute when route is matching
     *
     * @return string
     */
    public function getController();
}
