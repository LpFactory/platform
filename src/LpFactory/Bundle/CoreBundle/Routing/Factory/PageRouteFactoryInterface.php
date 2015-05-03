<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Routing\Factory;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use LpFactory\Bundle\CoreBundle\Routing\Configuration\AbstractPageRouteConfiguration;
use LpFactory\Bundle\CoreBundle\Routing\Model\NestedSetRoutingPageInterface;

/**
 * Class PageRouteFactoryInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Routing\Factory
 * @author jobou
 */
interface PageRouteFactoryInterface
{
    /**
     * Create a new route instance
     *
     * @param AbstractPageRouteConfiguration $routeConfiguration
     * @param NestedSetRoutingPageInterface  $page
     *
     * @return \Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route
     */
    public function create(AbstractPageRouteConfiguration $routeConfiguration, NestedSetRoutingPageInterface $page);

    /**
     * Create a new route instance from a page id
     *
     * @param AbstractPageRouteConfiguration $routeConfiguration
     * @param int                            $pageId
     *
     * @return \Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route
     */
    public function createFromId(AbstractPageRouteConfiguration $routeConfiguration, $pageId);
}
