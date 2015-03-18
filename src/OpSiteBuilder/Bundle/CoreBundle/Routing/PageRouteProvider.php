<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing;

use Symfony\Cmf\Component\Routing\Candidates\CandidatesInterface;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Route;
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
     * @var CandidatesInterface
     */
    protected $candidateStrategy;

    /**
     * Constructor
     *
     * @param CandidatesInterface $candidateStrategy
     */
    public function __construct(CandidatesInterface $candidateStrategy)
    {
        $this->candidateStrategy = $candidateStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteCollectionForRequest(Request $request)
    {
        $candidates = $this->candidateStrategy->getCandidates($request);
        var_dump($candidates);
        // TODO: Implement getRouteCollectionForRequest() method.
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
}