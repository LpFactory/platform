<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\DependencyInjection\Compiler;

use LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler\BlockConfigurationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class BlockConfigurationPassTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\DependencyInjection\Compiler
 * @author jobou
 */
class BlockConfigurationPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test process return null
     */
    public function testProcessNoDefinition()
    {
        $container = new ContainerBuilder();
        $blockConfigurationPass = new BlockConfigurationPass();
        $this->assertNull($blockConfigurationPass->process($container));
    }

    /**
     * Test process items
     */
    public function testProcessItems()
    {
        $definition = new Definition();
        $containerMock = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $containerMock
            ->expects($this->once())
            ->method('hasDefinition')
            ->willReturn(true);
        $containerMock
            ->expects($this->once())
            ->method('getDefinition')
            ->willReturn($definition);
        $containerMock
            ->expects($this->once())
            ->method('findTaggedServiceIds')
            ->willReturn(
                array(
                    'id1' => array(array('alias' => 'reference1')),
                    'id2' => array(array('alias' => 'reference2'))
                )
            );
        $blockConfigurationPass = new BlockConfigurationPass();
        $blockConfigurationPass->process($containerMock);
        $this->assertEquals(2, count($definition->getMethodCalls()));
    }
}
