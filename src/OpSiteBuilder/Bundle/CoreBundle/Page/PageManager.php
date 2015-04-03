<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Page;

use OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PageManager
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Page
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
     * Constructor
     *
     * @param ObjectManager         $pageManager
     * @param BlockManagerInterface $blockManager
     */
    public function __construct(ObjectManager $pageManager, BlockManagerInterface $blockManager)
    {
        $this->pageManager = $pageManager;
        $this->blockManager = $blockManager;
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
