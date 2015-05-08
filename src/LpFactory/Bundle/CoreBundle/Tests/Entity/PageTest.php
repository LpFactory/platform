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
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class PageTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Entity
 * @author jobou
 */
class PageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test shiftBlock
     */
    public function testShiftBlock()
    {
        $page = PageBlockHelper::createPageWithBlock();

        $page->shiftBlock(2);
        $blocks = $page->getBlocks();

        $this->assertEquals(1, $blocks[0]->getSort());
        $this->assertEquals(3, $blocks[1]->getSort());
        $this->assertEquals(4, $blocks[2]->getSort());
    }

    /**
     * Test all setter and getter
     */
    public function testSetterGetter()
    {
        $page = new Page();
        $this->assertEquals('default', $page->getAlias());

        $page->setTitle('title');
        $this->assertEquals('title', $page->getTitle());

        $page->setSlug('slug');
        $this->assertEquals('slug', $page->getSlug());

        $page->setLft(123);
        $this->assertEquals(123, $page->getLft());

        $page->setLvl(124);
        $this->assertEquals(124, $page->getLvl());

        $page->setRgt(125);
        $this->assertEquals(125, $page->getRgt());

        $page->setRoot(1);
        $this->assertEquals(1, $page->getRoot());

        $this->assertNull($page->getCreated());
        $this->assertNull($page->getUpdated());

        $this->assertFalse($page->isRoot());
        $page->setLvl(0);
        $this->assertTrue($page->isRoot());

        $this->assertTrue(count($page->getChildren()) === 0);
        $child = new Page();
        $page->addChild($child);
        $this->assertTrue(count($page->getChildren()) === 1);
        $page->removeChild($child);
        $this->assertTrue(count($page->getChildren()) === 0);

        $parent = new Page();
        $page->setParent($parent);
        $this->assertEquals($parent, $page->getParent());

        $this->assertTrue(count($page->getBlocks()) === 0);
        $block = $this
            ->getMock('LpFactory\Bundle\CoreBundle\Entity\Block');
        $page->addBlock($block);
        $this->assertTrue(count($page->getBlocks()) === 1);
        $page->removeBlock($block);
        $this->assertTrue(count($page->getBlocks()) === 0);

        $this->assertNull($page->getId());
    }
}
