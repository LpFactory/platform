<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Page;

use Doctrine\Common\Persistence\ObjectManager;
use OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface;
use OpSiteBuilder\Bundle\CoreBundle\Block\Strategy\BlockPositionStrategy;
use OpSiteBuilder\Bundle\CoreBundle\Block\Strategy\BlockPositionStrategyInterface;
use OpSiteBuilder\Bundle\CoreBundle\Entity\Page;
use OpSiteBuilder\Bundle\CoreBundle\Page\PageManager;
use OpSiteBuilder\Bundle\CoreBundle\Tests\Entity\TestUnitBlock;
use OpSiteBuilder\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class PageManagerTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Page
 * @author jobou
 */
class PageManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test addBlock
     */
    public function testAddBlock()
    {
        $page = PageBlockHelper::createPageWithBlock();

        $newBlock = new TestUnitBlock();

        $manager = $this->createPageManager();
        $manager->addBlock($page, $newBlock);

        $this->assertEquals(4, $newBlock->getSort());
    }

    /**
     * Test moveBlock
     */
    public function testMoveBlock()
    {
        $page = PageBlockHelper::createPageWithBlock();
        $blocks = $page->getBlocks();
        $movedBlock = $blocks[0];

        $manager = $this->createPageManager();
        $manager->moveBlock($page, $movedBlock, 2);

        $blocks = $page->getBlocks();
        $this->assertEquals(2, $movedBlock->getSort());
        foreach ($blocks as $block) {
            if ($block->getTitle() === 'block 3') {
                $this->assertEquals(3, $block->getSort());
            } elseif ($block->getTitle() === 'block 2') {
                $this->assertEquals(1, $block->getSort());
            }
        }
    }

    /**
     * Test save
     */
    public function testSave()
    {
        $pageManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $pageManager
            ->expects($this->once())
            ->method('persist');
        $pageManager
            ->expects($this->once())
            ->method('flush');

        $manager = $this->createPageManager($pageManager);
        $manager->save(new Page());

        $blockManager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');
        $blockManager
            ->expects($this->exactly(3))
            ->method('save');

        $page = PageBlockHelper::createPageWithBlock();
        $manager = $this->createPageManager(null, $blockManager);
        $manager->save($page, true, true);
    }

    /**
     * Create PageManager for testing
     *
     * @param ObjectManager                  $pageManager
     * @param BlockManagerInterface          $blockManager
     * @param BlockPositionStrategyInterface $positionStrategy
     *
     * @return PageManager
     */
    public function createPageManager(
        ObjectManager $pageManager = null,
        BlockManagerInterface $blockManager = null,
        BlockPositionStrategyInterface $positionStrategy = null
    ) {
        if ($pageManager === null) {
            $pageManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        }

        if ($blockManager === null) {
            $blockManager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');
        }

        if ($positionStrategy === null) {
            $positionStrategy = new BlockPositionStrategy();
        }

        return new PageManager($pageManager, $blockManager, $positionStrategy);
    }
}
