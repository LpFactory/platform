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
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use LpFactory\Bundle\CoreBundle\Model\Repository\PageRepositoryInterface;

/**
 * Class PageRepository
 *
 * @package LpFactory\Bundle\CoreBundle\Entity\Repository
 * @author jobou
 */
class PageRepository extends NestedTreeRepository implements PageRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPageInTree($slug, AbstractPage $root = null)
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
     * {@inheritdoc}
     */
    public function getCachedPath(AbstractPage $page)
    {
        $pageId = $page->getId();
        if (isset($this->cachedPaths[$pageId])) {
            return $this->cachedPaths[$pageId];
        }

        return $this->cachedPaths[$pageId] = $this->getPath($page);
    }

    /**
     * {@inheritdoc}
     */
    public function getSingleRootNode()
    {
        return $this->getRootNodesQuery()->getSingleResult();
    }
}
