<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Strategy;

use LpFactory\Bundle\CoreBundle\Block\Strategy\BlockPositionStrategy;
use LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitBlock;
use LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitPage;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class BlockPositionStrategyTest
 *
 * @author jobou
 */
class BlockPositionStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getPosition
     */
    public function testGetPosition()
    {
        $strategy = new BlockPositionStrategy();

        $this->assertEquals(
            4,
            $strategy->getPosition(new TestUnitBlock(), PageBlockHelper::createPageWithBlock())
        );
        $this->assertEquals(
            1,
            $strategy->getPosition(new TestUnitBlock(), new TestUnitPage())
        );
    }
}
