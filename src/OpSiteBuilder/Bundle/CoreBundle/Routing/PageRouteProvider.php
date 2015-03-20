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
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\DoctrineProvider;
use Symfony\Cmf\Component\Routing\Candidates\CandidatesInterface;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PageRouteProvider
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
class PageRouteProvider extends DoctrineProvider implements RouteProviderInterface
{
    /**
     * @var CandidatesInterface
     */
    protected $candidatesStrategy;

    /**
     * @var PageRouteFactoryInterface
     */
    protected $routeFactory;

    /**
     * Constructor
     *
     * @param PageRouteFactoryInterface $routeFactory
     * @param ManagerRegistry           $managerRegistry
     * @param CandidatesInterface       $candidatesStrategy
     * @param string                    $className
     *
     * @internal param CandidatesInterface $candidateStrategy
     */
    public function __construct(
        PageRouteFactoryInterface $routeFactory,
        ManagerRegistry $managerRegistry,
        CandidatesInterface $candidatesStrategy,
        $className
    ) {
        parent::__construct($managerRegistry, $className);

        $this->routeFactory = $routeFactory;
        $this->candidatesStrategy = $candidatesStrategy;
    }

    /**
     * {@inheritDoc}
     */
    public function getRouteCollectionForRequest(Request $request)
    {
        $collection = new RouteCollection();

        // Extract uri parts from requested path info
        $candidates = $this->candidatesStrategy->getCandidates($request);
        if (empty($candidates)) {
            return $collection;
        }

        // Get all pages matching the deepest uri part
        $deepestCandidate = array_pop($candidates);
        $pages = $this->getPageRepository()->findBySlug($deepestCandidate, array('lvl' => 'DESC'));

        /** @var $page AbstractPage */
        foreach ($pages as $page) {
            $path = $this->getPageRepository()->getPath($page);

            // If page path matches requested uri, add route
            if ($this->isPageMatchingUri($path, $request)) {
                $route = $this->routeFactory->create($page, $request->getPathInfo(), $path);

                $collection->add(
                    $route->getName(),
                    $route
                );
            }
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteByName($name)
    {
        // TODO: Implement getRouteByName() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutesByNames($names)
    {
        // TODO: Implement getRoutesByNames() method.
    }

    /**
     * @return \Gedmo\Tree\Entity\Repository\NestedTreeRepository
     */
    protected function getPageRepository()
    {
        return $this->getObjectManager()->getRepository($this->className);
    }

    /**
     * Check if a page matches the request
     *
     * @param array   $path
     * @param Request $request
     *
     * @return bool
     *
     * @internal param AbstractPage $page
     */
    protected function isPageMatchingUri(array $path, Request $request)
    {
        // Remove root level (no multi tree support for now)
        // TODO : multi tree support
        array_shift($path);

        // Build uri from tree path
        /** @var $item AbstractPage */
        $uri = array_reduce($path, function($carry, $item) {
            return $carry .= '/' . $item->getSlug();
        });

        // Compare requested uri with the built one
        return $uri === $request->getPathInfo();
    }
}