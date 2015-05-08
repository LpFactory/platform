<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Configuration;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMap;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMapChain;
use LpFactory\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;

/**
 * Class BlockMapChainTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block\Configuration
 * @author jobou
 */
class BlockMapChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test addMap getMap hasMap
     *
     * @expectedException \LogicException
     */
    public function testAddGetHasMap()
    {
        $blockMapChain = new BlockMapChain();
        $blockMap = ConfigurationHelper::createBlockMap();
        $blockMapChain->addMap($blockMap, 'test');

        $this->assertEquals('Test1', $blockMapChain->getMap('test')->getClass());
        $this->assertEquals(true, $blockMapChain->has('test'));
        $this->assertEquals(false, $blockMapChain->has('unknown'));
        $this->assertEquals(array('test'), $blockMapChain->keys());
        $this->assertEquals(array('test' => $blockMap), $blockMapChain->all());

        // Throw exception
        $blockMapChain->getMap('unknown');
    }

    /**
     * Test getDiscriminatorMap
     */
    public function testGetDiscriminatorMap()
    {
        $blockMapChain = new BlockMapChain();
        $blockMap1 = ConfigurationHelper::createBlockMap();
        $blockMapChain->addMap($blockMap1, 'test1');
        $blockMap2 = ConfigurationHelper::createBlockMap(2);
        $blockMapChain->addMap($blockMap2, 'test2');

        $this->assertEquals(array('test1' => 'Test1', 'test2' => 'Test2'), $blockMapChain->getDiscriminatorMap());
    }
}
