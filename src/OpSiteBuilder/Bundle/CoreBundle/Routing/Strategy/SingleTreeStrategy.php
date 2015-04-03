<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy;

use OpSiteBuilder\Bundle\CoreBundle\Model\Repository\PageRepositoryInterface;

/**
 * Class SingleTreeStrategy
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy
 * @author jobou
 */
class SingleTreeStrategy implements PageTreeStrategyInterface
{
    /**
     * @var PageRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor
     *
     * @param PageRepositoryInterface $repository
     */
    public function __construct(PageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Single tree strategy
     * Be sure you only have one root node for one website
     *
     * {@inheritdoc}
     */
    public function getRootNode($hostName)
    {
        return $this->repository->getRootNodeForHostname($hostName);
    }
}
