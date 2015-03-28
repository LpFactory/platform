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
use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\AbstractPageRouteConfiguration;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationChainInterface;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Satinizer\UrlSatinizerChainInterface;
use Symfony\Cmf\Component\Routing\ChainedRouterInterface;
use Symfony\Cmf\Component\Routing\LazyRouteCollection;
use Symfony\Cmf\Component\Routing\NestedMatcher\FinalMatcherInterface;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class PageDynamicRouter
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
class PageDynamicRouter implements ChainedRouterInterface, RequestMatcherInterface
{
    /**
     * @var RequestContext
     */
    protected $context;

    /**
     * @var PageRouteConfigurationChainInterface
     */
    protected $routeConfigurationChain;

    /**
     * @var RouteProviderInterface
     */
    protected $provider;

    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    /**
     * @var FinalMatcherInterface
     */
    protected $finalMatcher;

    /**
     * Constructor
     *
     * @param PageRouteConfigurationChainInterface $routeConfigurationChain
     * @param RouteProviderInterface               $provider
     * @param FinalMatcherInterface                $finalMatcher
     */
    public function __construct(
        PageRouteConfigurationChainInterface $routeConfigurationChain,
        RouteProviderInterface $provider,
        FinalMatcherInterface $finalMatcher
    ) {
        $this->routeConfigurationChain = $routeConfigurationChain;
        $this->provider = $provider;
        $this->finalMatcher = $finalMatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteCollection()
    {
        if (!$this->routeCollection instanceof RouteCollection) {
            $this->routeCollection = $this->provider
                ? new LazyRouteCollection($this->provider) : new RouteCollection();
        }

        return $this->routeCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        // TODO: Implement generate() method.
    }

    /**
     * {@inheritdoc}
     */
    public function match($pathInfo)
    {
        // This router works only with request matching
        $request = Request::create($pathInfo);

        return $this->matchRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public function matchRequest(Request $request)
    {
        $collection = $this->provider->getRouteCollectionForRequest($request);
        if (!count($collection)) {
            throw new ResourceNotFoundException();
        }

        return $this->finalMatcher->finalMatch($collection, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($name)
    {
        // This router supports all AbstractPage object
        if ($name instanceof AbstractPage) {
            return true;
        }

        // Check if the route name matches one from a route configuration
        return $this->routeConfigurationChain->supports($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteDebugMessage($name, array $parameters = array())
    {
        // TODO: Implement getRouteDebugMessage() method.
    }

    /**
     * {@inheritdoc}
     */
    public function setContext(RequestContext $context)
    {
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    public function getContext()
    {
        return $this->context;
    }
}
