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
use LpFactory\Bundle\CoreBundle\Routing\Model\Repository\NestedSetRoutingPageRepositoryInterface;
use LpFactory\Bundle\CoreBundle\Routing\Configuration\AbstractPageRouteConfiguration;
use LpFactory\Bundle\CoreBundle\Routing\Model\NestedSetRoutingPageInterface;
use LpFactory\Bundle\CoreBundle\Routing\Strategy\AbstractTreeStrategy;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route;

/**
 * Class PageRouteFactory
 *
 * @package LpFactory\Bundle\CoreBundle\Routing\Factory
 * @author jobou
 */
class PageRouteFactory implements PageRouteFactoryInterface
{
    /**
     * @var NestedSetRoutingPageRepositoryInterface
     */
    protected $repository;

    /**
     * @var AbstractTreeStrategy
     */
    protected $treeStrategy;

    /**
     * Constructor
     *
     * @param NestedSetRoutingPageRepositoryInterface $repository
     * @param AbstractTreeStrategy                    $treeStrategy
     */
    public function __construct(
        NestedSetRoutingPageRepositoryInterface $repository,
        AbstractTreeStrategy $treeStrategy
    ) {
        $this->repository = $repository;
        $this->treeStrategy = $treeStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function create(
        AbstractPageRouteConfiguration $routeConfiguration,
        NestedSetRoutingPageInterface $page
    ) {
        $path = $this->repository->getCachedPath($page);
        $pathInfo = $this->buildUrlFromPath($path);

        $route = new Route();
        $route->setName($routeConfiguration->getPageRouteName($page));
        $route->setPath($routeConfiguration->buildPath($pathInfo));
        $route->setDefaults(array(
            '_controller' => $routeConfiguration->getController(),
            'page' => $page,
            'path' => $path
        ));

        return $route;
    }

    /**
     * Create a new route instance from a page id
     *
     * @param AbstractPageRouteConfiguration $routeConfiguration
     * @param int                            $pageId
     *
     * @return \Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route
     */
    public function createFromId(AbstractPageRouteConfiguration $routeConfiguration, $pageId)
    {
        $page = $this->repository->find($pageId);

        return $this->create($routeConfiguration, $page);
    }

    /**
     * Build an url from a path
     *
     * @param array $path
     *
     * @return string
     */
    protected function buildUrlFromPath(array $path)
    {
        // Remove root level (homepage)
        array_shift($path);

        // Homepage
        if (count($path) === 0 && $this->treeStrategy->isHomeTreeRoot()) {
            return '/';
        }

        // Build uri from tree path
        return array_reduce($path, function ($carry, AbstractPage $item) {
            $carry .= '/' . $item->getSlug();
            return $carry;
        });
    }
}
