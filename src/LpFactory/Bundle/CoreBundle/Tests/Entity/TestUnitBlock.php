<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Entity;

use LpFactory\Bundle\CoreBundle\Entity\Block;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class TestUnitBlock
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Entity
 * @author jobou
 */
class TestUnitBlock extends Block
{
    /**
     * Get the name of a block
     *
     * @return string
     */
    public function getAlias()
    {
        return 'test_unit';
    }

    /**
     * Check if block is empty
     * If null, use the manager to fetch data and see if block is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return false;
    }
}
