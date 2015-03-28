<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Entity\Repository;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Gedmo\Tree\RepositoryInterface;

/**
 * Interface PageRepositoryInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Entity\Repository
 * @author jobou
 */
interface PageRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a root page for a specific hostname
     *
     * @param string $hostName
     *
     * @return AbstractPage
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRootPageForHostname($hostName);

    /**
     * Find a page in a specific tree
     *
     * @param string       $slug
     * @param AbstractPage $root
     *
     * @return array
     */
    public function getPageInTree($slug, AbstractPage $root = null);
}
