<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Twig;

use LpFactory\Bundle\CoreBundle\Twig\SerializerExtension;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class SerializerExtensionTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Twig
 * @author jobou
 */
class SerializerExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test serialize
     */
    public function testSerialize()
    {
        $serializer = $this->getMock('Symfony\Component\Serializer\SerializerInterface');
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn(array('test'));

        $extension = new SerializerExtension($serializer);

        $this->assertEquals(array('test'), $extension->serialize(PageBlockHelper::createBlock()));
    }

    /**
     * Test getFilters
     */
    public function testGetFilters()
    {
        $serializer = $this->getMock('Symfony\Component\Serializer\SerializerInterface');
        $extension = new SerializerExtension($serializer);

        $filters = $extension->getFilters();
        $this->assertEquals(1, count($filters));

        $this->assertEquals('lpfactory_serialize', $filters[0]->getName());
        $callable = $filters[0]->getCallable();
        $this->assertTrue(method_exists($extension, $callable[1]));
    }

    /**
     * Test getName
     */
    public function testGetName()
    {
        $serializer = $this->getMock('Symfony\Component\Serializer\SerializerInterface');
        $extension = new SerializerExtension($serializer);

        $this->assertEquals('lp_factory_serializer_extension', $extension->getName());
    }
}
