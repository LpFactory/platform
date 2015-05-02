<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block;

use LpFactory\Bundle\CoreBundle\Block\Exception\UnknownBlockTypeException;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockFactoryInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block
 * @author jobou
 */
interface BlockFactoryInterface
{
    /**
     * Get a new instance of a specific bloc
     *
     * @param string $type
     *
     * @return AbstractBlock
     *
     * @throws UnknownBlockTypeException
     */
    public function create($type);
}
