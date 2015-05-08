<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block;

use LpFactory\Bundle\CoreBundle\Block\BlockManager;
use LpFactory\Bundle\CoreBundle\Tests\Entity\EmptyUnitBlock;
use LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitBlock;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class BlockManagerTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block
 * @author jobou
 */
class BlockManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getData and isEmpty
     */
    public function testGetDataAndIsEmpty()
    {
        $data = array('1', '2', '3');

        $doctrine = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $providerChain = $this->getMock('LpFactory\Bundle\CoreBundle\Block\Provider\BlockDataProviderChainInterface');

        $provider = $this->getMock('LpFactory\Bundle\CoreBundle\Block\Provider\BlockDataProviderInterface');
        $provider
            ->method('getData')
            ->willReturn($data);

        $providerChain
            ->method('getProvider')
            ->willReturn($provider);

        $emptyBlock = new EmptyUnitBlock();

        $manager = new BlockManager($providerChain, $doctrine);
        $this->assertEquals(
            false,
            $manager->isEmpty($emptyBlock)
        );
        $this->assertEquals(
            false,
            $manager->isEmpty($emptyBlock)
        );
        $this->assertEquals(
            $data,
            $manager->getData(PageBlockHelper::createBlock())
        );
        $this->assertEquals(
            false,
            $manager->isEmpty(PageBlockHelper::createBlock())
        );
    }

    /**
     * Test remove
     */
    public function testRemove()
    {
        $doctrine = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $doctrine
            ->expects($this->once())
            ->method('flush');
        $doctrine
            ->expects($this->once())
            ->method('remove');

        $providerChain = $this->getMock('LpFactory\Bundle\CoreBundle\Block\Provider\BlockDataProviderChainInterface');
        $manager = new BlockManager($providerChain, $doctrine);
        $manager->remove(new TestUnitBlock());
    }

    /**
     * Test save
     */
    public function testSave()
    {
        $doctrine = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $doctrine
            ->expects($this->once())
            ->method('flush');
        $doctrine
            ->expects($this->once())
            ->method('persist');

        $providerChain = $this->getMock('LpFactory\Bundle\CoreBundle\Block\Provider\BlockDataProviderChainInterface');
        $manager = new BlockManager($providerChain, $doctrine);
        $manager->save(new TestUnitBlock());
    }
}
