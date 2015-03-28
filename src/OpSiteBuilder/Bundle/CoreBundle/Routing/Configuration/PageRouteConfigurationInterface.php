<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration;

/**
 * Interface PageRouteConfigurationInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration
 * @author jobou
 */
interface PageRouteConfigurationInterface
{
    /**
     * Get the prefix used in the route
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Get the request to be match with the request
     *
     * @return string|null
     */
    public function getRegex();

    /**
     * Get the controller to execute when route is matching
     *
     * @return string
     */
    public function getController();

    /**
     * Get optional path if the one built with page path must be changed
     *
     * @return string|null
     */
    public function getPath();

    /**
     * Check if the route configuration supports this route name
     *
     * @param string $name
     *
     * @return bool
     */
    public function supports($name);
}
