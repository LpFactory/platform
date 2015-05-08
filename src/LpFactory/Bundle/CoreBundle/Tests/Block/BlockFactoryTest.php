<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block;

use LpFactory\Bundle\CoreBundle\Block\BlockFactory;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMap;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMapChain;

/**
 * Class BlockFactoryTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block
 * @author jobou
 */
class BlockFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test create
     *
     * @expectedException \LpFactory\Bundle\CoreBundle\Block\Exception\UnknownBlockTypeException
     */
    public function testCreate()
    {
        $blockMapChain = new BlockMapChain();
        $blockMap = new BlockMap(array('class' => 'LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitBlock'));
        $blockMapChain->addMap($blockMap, 'test_unit');

        $blockFactory = new BlockFactory($blockMapChain);
        $this->assertInstanceOf('LpFactory\Bundle\CoreBundle\Model\AbstractBlock', $blockFactory->create('test_unit'));

        // Exception
        $blockFactory->create('unknown_type');
    }
}
