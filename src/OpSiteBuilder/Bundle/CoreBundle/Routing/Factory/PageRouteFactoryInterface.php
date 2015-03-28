<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Factory;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationInterface;

/**
 * Class PageRouteFactoryInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Factory
 * @author jobou
 */
interface PageRouteFactoryInterface
{
    /**
     * Create a new route instance
     *
     * @param PageRouteConfigurationInterface $routeConfiguration
     * @param AbstractPage                    $page
     * @param string                          $path
     *
     * @return \Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route
     */
    public function create(PageRouteConfigurationInterface $routeConfiguration, AbstractPage $page, $path);
}