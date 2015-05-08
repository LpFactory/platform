<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\DependencyInjection\Compiler;

use LpFactory\Bundle\CoreBundle\DependencyInjection\Compiler\DoctrineResolverTargetModelPass;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class DoctrineResolverTargetModelPassTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\DependencyInjection\Compiler
 * @author jobou
 */
class DoctrineResolverTargetModelPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test process items
     */
    public function testProcessItems()
    {
        $definition = new Definition();
        $containerMock = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $containerMock
            ->expects($this->once())
            ->method('findDefinition')
            ->willReturn($definition);

        $doctrinePassMock = new DoctrineResolverTargetModelPass();
        $doctrinePassMock->process($containerMock);
        $this->assertEquals(2, count($definition->getMethodCalls()));
    }
}
