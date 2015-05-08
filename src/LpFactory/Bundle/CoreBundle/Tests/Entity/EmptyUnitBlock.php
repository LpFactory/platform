<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Entity;

/**
 * Class EmptyUnitBlock
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Entity
 * @author jobou
 */
class EmptyUnitBlock extends TestUnitBlock
{
    /**
     * @return int
     */
    public function getId()
    {
        return 158;
    }

    /**
     * Check if block is empty
     * If null, use the manager to fetch data and see if block is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return null;
    }
}
