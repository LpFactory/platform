<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use OpSiteBuilder\Bundle\CoreBundle\Model\Repository\PageRepositoryInterface;

/**
 * Class AbstractTreeStrategy
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy
 * @author jobou
 */
abstract class AbstractTreeStrategy
{
    /**
     * @var PageRepositoryInterface
     */
    protected $repository;

    /**
     * @var bool
     */
    protected $isHomeTreeRoot;

    /**
     * Constructor
     *
     * @param PageRepositoryInterface $repository
     * @param bool                    $isHomeTreeRoot
     */
    public function __construct(
        PageRepositoryInterface $repository,
        $isHomeTreeRoot = true
    ) {
        $this->repository = $repository;
        $this->isHomeTreeRoot = $isHomeTreeRoot;
    }

    /**
     * Is home path the root noot of the tree
     *
     * @return bool
     */
    public function isHomeTreeRoot()
    {
        return $this->isHomeTreeRoot;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage($slug, $hostName)
    {
        $rootPage = $this->getRootNode($hostName);

        // Slug empty then / has been requested
        if ($slug === "" && $this->isHomeTreeRoot()) {
            return array($rootPage);
        }

        return $this->repository->getPageInTree($slug, $rootPage);
    }

    /**
     * {@inheritdoc}
     */
    public function getDeepestPageSlug($pathInfo)
    {
        $explodedPathInfo = explode('/', $pathInfo);

        return array_pop($explodedPathInfo);
    }

    /**
     * Get the root node of a tree according to hostname
     * Used for multi tree strategy (one per hostname)
     *
     * @param string $hostName
     *
     * @return AbstractPage
     */
    abstract public function getRootNode($hostName);
}
