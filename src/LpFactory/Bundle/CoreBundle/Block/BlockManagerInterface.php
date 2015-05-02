<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block;

use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockManagerInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block
 * @author jobou
 */
interface BlockManagerInterface
{
    /**
     * Check if block is empty
     *
     * @param AbstractBlock $block
     *
     * @return bool
     */
    public function isEmpty(AbstractBlock $block);

    /**
     * Get data of block
     *
     * @param AbstractBlock $block
     *
     * @return mixed
     */
    public function getData(AbstractBlock $block);

    /**
     * Save a block
     *
     * @param AbstractBlock $block
     * @param bool          $flush
     *
     * @return null
     */
    public function save(AbstractBlock $block, $flush = true);

    /**
     * Remove a block
     *
     * @param AbstractBlock $block
     * @param bool          $flush
     *
     * @return null
     */
    public function remove(AbstractBlock $block, $flush = true);
}
