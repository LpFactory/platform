<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class PageRouteFactoryInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
interface PageRouteFactoryInterface 
{
    /**
     * Create a new route instance
     *
     * @param AbstractPage $page
     * @param string       $path
     *
     * @return \Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route
     */
    public function create(AbstractPage $page, $path);
}