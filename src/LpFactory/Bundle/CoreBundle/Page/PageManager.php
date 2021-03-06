<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Page;

use LpFactory\Bundle\CoreBundle\Block\BlockManagerInterface;
use LpFactory\Bundle\CoreBundle\Block\Strategy\BlockPositionStrategyInterface;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PageManager
 *
 * @package LpFactory\Bundle\CoreBundle\Page
 * @author jobou
 */
class PageManager implements PageManagerInterface
{
    /**
     * @var ObjectManager
     */
    protected $pageManager;

    /**
     * @var BlockManagerInterface
     */
    protected $blockManager;

    /**
     * @var BlockPositionStrategyInterface
     */
    protected $positionStrategy;

    /**
     * Constructor
     *
     * @param ObjectManager                  $pageManager
     * @param BlockManagerInterface          $blockManager
     * @param BlockPositionStrategyInterface $positionStrategy
     */
    public function __construct(
        ObjectManager $pageManager,
        BlockManagerInterface $blockManager,
        BlockPositionStrategyInterface $positionStrategy
    ) {
        $this->pageManager = $pageManager;
        $this->blockManager = $blockManager;
        $this->positionStrategy = $positionStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function addBlock(AbstractPage $page, AbstractBlock $block, $position = false)
    {
        // No position, use custom strategy to get a position
        if ($position === false) {
            $position = $this->positionStrategy->getPosition($block, $page);
        }

        // Insert a block at its sort position
        $block->setSort($position);

        // Shift sort in existing block
        $page->shiftBlock($position);

        // Add new block
        $page->addBlock($block);
    }

    /**
     * {@inheritdoc}
     */
    public function moveBlock(AbstractPage $page, AbstractBlock $block, $position)
    {
        if ($page->getBlockIndex($block) === 0) {
            $page->removeBlock($block);
            $page->resetBlockSort();
            $page->addBlock($block);
        }

        // Shift sort in existing block
        $page->shiftBlock($position);

        // Set new position for block
        $block->setSort($position);
    }

    /**
     * {@inheritdoc}
     */
    public function save(AbstractPage $page, $flush = true, $cascade = false)
    {
        // Persist page
        $this->pageManager->persist($page);

        // Persist blocks too
        if ($cascade) {
            foreach ($page->getBlocks() as $block) {
                $this->blockManager->save($block, false);
            }
        }

        // Flush
        if ($flush) {
            $this->pageManager->flush();
        }
    }
}
