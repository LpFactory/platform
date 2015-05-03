<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Routing\Strategy;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use LpFactory\Bundle\CoreBundle\Routing\Model\Repository\NestedSetRoutingPageRepositoryInterface;

/**
 * Class AbstractTreeStrategy
 *
 * @package LpFactory\Bundle\CoreBundle\Routing\Strategy
 * @author jobou
 */
abstract class AbstractTreeStrategy
{
    /**
     * @var NestedSetRoutingPageRepositoryInterface
     */
    protected $repository;

    /**
     * @var bool
     */
    protected $isHomeTreeRoot;

    /**
     * Constructor
     *
     * @param NestedSetRoutingPageRepositoryInterface $repository
     * @param bool                                    $isHomeTreeRoot
     */
    public function __construct(
        NestedSetRoutingPageRepositoryInterface $repository,
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
