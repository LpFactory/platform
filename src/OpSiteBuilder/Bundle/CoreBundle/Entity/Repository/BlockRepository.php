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
     * {@inheritdoc}
     */
    public function findBlockInPageById($blockId, $pageId)
    {
        $qb = $this
            ->createQueryBuilder('block')
            ->select('block, page')
            ->leftJoin('block.page', 'page')
            ->where('block.id = :blockId')
            ->andWhere('page.id = :pageId')
            ->setParameter('blockId', $blockId)
            ->setParameter('pageId', $pageId);

        return $qb->getQuery()->getSingleResult();
    }
}
