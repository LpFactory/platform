<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Entity;

use LpFactory\Bundle\CoreBundle\Entity\Page;

/**
 * Class BlockTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Entity
 * @author jobou
 */
class BlockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test all setter and getter
     */
    public function testSetterGetter()
    {
        $block = new TestUnitBlock();

        $this->assertNull($block->getId());

        $block->setSort(1);
        $this->assertEquals(1, $block->getSort());
        $block->incSort();
        $this->assertEquals(2, $block->getSort());

        $block->setTitle('title');
        $this->assertEquals('title', $block->getTitle());

        $this->assertNull($block->getCreated());
        $this->assertNull($block->getUpdated());

        $this->assertFalse($block->isEditable());

        $page = new Page();
        $block->setPage($page);
        $this->assertEquals($page, $block->getPage());

        $this->assertEquals('test_unit', $block->getAlias());

        $this->assertFalse($block->isEmpty());
    }
}
