<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests;

use OpSiteBuilder\Bundle\CoreBundle\Entity\Page;
use OpSiteBuilder\Bundle\CoreBundle\Tests\Entity\TestUnitBlock;

/**
 * Class PageBlockHelper
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests
 * @author jobou
 */
class PageBlockHelper
{
    /**
     * Create a page with 3 block
     *
     * @return Page
     */
    public static function createPageWithBlock()
    {
        $block1 = new TestUnitBlock();
        $block1->setSort(1);
        $block1->setTitle('block 1');

        $block2 = new TestUnitBlock();
        $block2->setSort(2);
        $block2->setTitle('block 2');

        $block3 = new TestUnitBlock();
        $block3->setSort(3);
        $block3->setTitle('block 3');

        $page = new Page();
        $page->addBlock($block1);
        $page->addBlock($block2);
        $page->addBlock($block3);

        return $page;
    }
}
