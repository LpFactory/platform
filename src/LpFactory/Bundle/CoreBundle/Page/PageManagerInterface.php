<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Page;

use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface PageManagerInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Page
 * @author jobou
 */
interface PageManagerInterface
{
    /**
     * Add a new block to a page
     *
     * @param AbstractPage  $page
     * @param AbstractBlock $block
     *
     * @return null
     */
    public function addBlock(AbstractPage $page, AbstractBlock $block);


    /**
     * move the block to the new position in the page
     *
     * @param AbstractPage  $page
     * @param AbstractBlock $block
     * @param int           $position
     *
     * @return null
     */
    public function moveBlock(AbstractPage $page, AbstractBlock $block, $position);

    /**
     * Save a page
     *
     * @param AbstractPage $page
     * @param bool         $flush
     * @param bool         $cascade
     *
     * @return null
     */
    public function save(AbstractPage $page, $flush = true, $cascade = false);
}
