<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Provider;

use OpSiteBuilder\Bundle\CoreBundle\Entity\Repository\PageRepositoryInterface;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\AbstractPageRouteConfiguration;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationChainInterface;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationInterface;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Factory\PageRouteFactoryInterface;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Satinizer\UrlSatinizerChainInterface;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class PageRouteProvider
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
class PageRouteProvider implements RouteProviderInterface
{
    /**
     * @var PageRouteFactoryInterface
     */
    protected $routeFactory;

    /**
     * @var PageRouteConfigurationChainInterface
     */
    protected $routeConfigurationChain;

    /**
     * @var UrlSatinizerChainInterface
     */
    protected $urlSatinizerChain;

    /**
     * @var PageRepositoryInterface
     */
    protected $pageRepository;

    /**
     * Constructor
     *
     * @param PageRouteFactoryInterface            $routeFactory
     * @param UrlSatinizerChainInterface           $urlSatinizerChain
     * @param PageRouteConfigurationChainInterface $routeConfigurationChain
     * @param PageRepositoryInterface              $pageRepository
     */
    public function __construct(
        PageRouteFactoryInterface $routeFactory,
        UrlSatinizerChainInterface $urlSatinizerChain,
        PageRouteConfigurationChainInterface $routeConfigurationChain,
        PageRepositoryInterface $pageRepository
    ) {
        $this->routeFactory = $routeFactory;
        $this->urlSatinizerChain = $urlSatinizerChain;
        $this->routeConfigurationChain = $routeConfigurationChain;
        $this->pageRepository = $pageRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function getRouteCollectionForRequest(Request $request)
    {
        $collection = new RouteCollection();

        $pathInfo = $this->urlSatinizerChain->clean($request->getPathInfo());
        $hostName = $request->getHost();

        /** @var AbstractPageRouteConfiguration $configuration */
        foreach ($this->routeConfigurationChain as $configuration) {
            if (null !== $extractedPathInfo = $configuration->isMatching($pathInfo)) {
                $this->appendRouteToCollection($collection, $configuration, $extractedPathInfo, $hostName);
                break;
            }
        }

        return $collection;
    }

    protected function appendRouteToCollection(
        RouteCollection $collection,
        PageRouteConfigurationInterface $configuration,
        $pathInfo,
        $hostName
    ) {
        $explodedPathInfo = explode('/', $pathInfo);
        $deepestCandidate = array_pop($explodedPathInfo);

        $rootPage = $this->pageRepository->getRootPageForHostname($hostName);
        $pages = $this->pageRepository->getPageInTree($deepestCandidate, $rootPage);

        /** @var AbstractPage $page */
        foreach ($pages as $page) {
            $path = $this->pageRepository->getPath($page);

            // If page path matches requested uri, add route
            if ($pathInfo === $this->buildUrlFromPath($path)) {
                $route = $this->routeFactory->create($configuration, $page, $pathInfo, $path);

                $collection->add(
                    $route->getName(),
                    $route
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteByName($name)
    {
        /** @var PageRouteConfigurationInterface $configuration */
        foreach ($this->routeConfigurationChain as $configuration) {
            if (null !== $pageId = $configuration->extractId($name)) {
                $page = $this->pageRepository->find($pageId);
                $path = $this->pageRepository->getPath($page);

                return $this->routeFactory->create(
                    $configuration,
                    $page,
                    $this->buildUrlFromPath($path),
                    $path
                );
            }
        }

        throw new RouteNotFoundException($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutesByNames($names)
    {
        return array();
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
        // Remove root level (no multi tree support for now)
        // TODO : multi tree support
        array_shift($path);

        // Build uri from tree path
        return array_reduce($path, function ($carry, AbstractPage $item) {
            return $carry .= '/' . $item->getSlug();
        });
    }
}
