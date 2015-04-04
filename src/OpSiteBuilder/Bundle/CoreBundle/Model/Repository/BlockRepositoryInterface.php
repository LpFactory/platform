<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Model\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockRepositoryInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Model\Repository
 * @author jobou
 */
interface BlockRepositoryInterface extends ObjectRepository
{
    /**
     * Find a block with his page by ids
     *
     * @param int $blockId
     * @param int $pageId
     *
     * @return AbstractBlock
     */
    public function findBlockInPageById($blockId, $pageId);
}
