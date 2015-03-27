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
 * Interface PageRouteConfigurationChainInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
interface PageRouteConfigurationChainInterface 
{
    /**
     * Add a route configuration
     *
     * @param string $alias
     * @param array  $configuration
     */
    public function add($alias, array $configuration);

    /**
     * Get a route configuration
     *
     * @param string $alias
     *
     * @return PageRouteConfigurationInterface
     */
    public function get($alias);

    /**
     * Get all routes configuration
     *
     * @return array
     */
    public function all();
}
