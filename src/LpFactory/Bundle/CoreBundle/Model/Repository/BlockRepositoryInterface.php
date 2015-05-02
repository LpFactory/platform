<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Model\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockRepositoryInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Model\Repository
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

    /**
     * Find a block and load the page
     *
     * @param int $blockId
     *
     * @return mixed
     */
    public function findWithPage($blockId);
}
