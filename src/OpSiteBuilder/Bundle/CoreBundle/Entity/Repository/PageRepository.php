<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Entity\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class PageRepository
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Entity\Repository
 * @author jobou
 */
class PageRepository extends NestedTreeRepository implements PageRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRootPageForHostname($hostName)
    {
        return $this->getRootNodesQuery()->getSingleResult();
    }

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
}
