<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy;

use Doctrine\ORM\NonUniqueResultException;

/**
 * Class SingleTreeStrategy
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy
 * @author jobou
 */
class SingleTreeStrategy extends AbstractTreeStrategy
{
    /**
     * Single tree strategy
     * Be sure you only have one root node for one website
     *
     * @throws NonUniqueResultException
     *
     * {@inheritdoc}
     */
    public function getRootNode($hostName)
    {
        return $this->repository->getSingleRootNode();
    }
}
