<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Model\Repository;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Gedmo\Tree\RepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface PageRepositoryInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Entity\Repository
 * @author jobou
 */
interface PageRepositoryInterface extends RepositoryInterface, ObjectRepository
{
    /**
     * Find a page per slug in a specific tree
     *
     * @param string       $slug
     * @param AbstractPage $root
     *
     * @return array
     */
    public function getPageInTree($slug, AbstractPage $root = null);

    /**
     * Get a path from memory if available
     *
     * @param AbstractPage $page
     *
     * @return array
     */
    public function getCachedPath(AbstractPage $page);
}
