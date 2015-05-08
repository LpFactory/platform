<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Entity\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use LpFactory\Bundle\CoreBundle\Exception\LpFactoryException;
use LpFactory\Bundle\NestedSetRoutingBundle\Model\NestedSetRoutingPageInterface;
use LpFactory\Bundle\NestedSetRoutingBundle\Model\Repository\NestedSetRoutingPageRepositoryInterface;

/**
 * Class PageRepository
 *
 * @package LpFactory\Bundle\CoreBundle\Entity\Repository
 * @author jobou
 */
class PageRepository extends NestedTreeRepository implements NestedSetRoutingPageRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPageInTree($slug, NestedSetRoutingPageInterface $root = null)
    {
        $qb = $this
            ->createQueryBuilder('page')
            ->where('page.slug = :slug')
            ->setParameter('slug', $slug);

        if ($root !== null) {
            $qb
                ->andWhere('page.root = :root')
                ->setParameter('root', $root);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @var array
     */
    protected $cachedPaths = array();

    /**
     * Get path and cache result
     *
     * @param NestedSetRoutingPageInterface $page
     *
     * @return array
     *
     * @throws LpFactoryException
     */
    public function getPath($page)
    {
        if (!$page instanceof NestedSetRoutingPageInterface) {
            throw new LpFactoryException('Page entity must implement NestedSetRoutingPageInterface');
        }

        $pageId = $page->getId();
        if (isset($this->cachedPaths[$pageId])) {
            return $this->cachedPaths[$pageId];
        }

        return $this->cachedPaths[$pageId] = parent::getPath($page);
    }

    /**
     * {@inheritdoc}
     */
    public function getSingleRootNode()
    {
        return $this->getRootNodesQuery()->getSingleResult();
    }
}
