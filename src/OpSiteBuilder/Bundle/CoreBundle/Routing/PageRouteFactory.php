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
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route;

/**
 * Class PageRouteFactory
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
class PageRouteFactory implements PageRouteFactoryInterface
{
    /**
     * @var string
     */
    protected $routePrefix;

    /**
     * Constructor
     *
     * @param string $routeNamePrefix
     */
    public function __construct($routeNamePrefix)
    {
        $this->routePrefix = $routeNamePrefix;
    }

    /**
     * {@inheritdoc}
     */
    public function create(AbstractPage $page, $path, array $breadcrumbs = array())
    {
        $route = new Route();
        $route->setName($this->routePrefix . $page->getId());
        $route->setPath($path);
        $route->setDefaults(array(
            '_controller' => 'OpSiteBuilderCoreBundle:Page:index',
            'page' => $page,
            'path' => $breadcrumbs
        ));

        return $route;
    }
}
