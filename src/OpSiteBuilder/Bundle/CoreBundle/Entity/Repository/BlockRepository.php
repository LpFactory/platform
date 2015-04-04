<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use OpSiteBuilder\Bundle\CoreBundle\Model\Repository\BlockRepositoryInterface;

/**
 * Class BlockRepository
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Entity\Repository
 * @author jobou
 */
class BlockRepository extends EntityRepository implements BlockRepositoryInterface
{
    /**
     * Create a query builder to get block with page
     *
     * @param int $blockId
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function createBlockWithPageQb($blockId)
    {
        return $this
            ->createQueryBuilder('block')
            ->select('block, page')
            ->leftJoin('block.page', 'page')
            ->where('block.id = :blockId')
            ->setParameter('blockId', $blockId);
    }

    /**
     * {@inheritdoc}
     */
    public function findBlockInPageById($blockId, $pageId)
    {
        $qb = $this
            ->createBlockWithPageQb($blockId)
            ->andWhere('page.id = :pageId')
            ->setParameter('pageId', $pageId);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findWithPage($blockId)
    {
        $qb = $this->createBlockWithPageQb($blockId);

        return $qb->getQuery()->getSingleResult();
    }
}
