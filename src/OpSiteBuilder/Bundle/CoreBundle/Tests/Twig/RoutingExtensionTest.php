<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Twig;

use OpSiteBuilder\Bundle\CoreBundle\Tests\Entity\TestUnitPage;
use OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\RoutingHelper;
use OpSiteBuilder\Bundle\CoreBundle\Twig\RoutingExtension;

/**
 * Class RoutingExtensionTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Twig
 * @author jobou
 */
class RoutingExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getOpPath
     */
    public function testGetOpPath()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $generator
            ->expects($this->once())
            ->method('generate')
            ->willReturn('/path/to/page');

        $viewConfiguration = RoutingHelper::createViewConfiguration();
        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationChainInterface');
        $configuration
            ->expects($this->once())
            ->method('get')
            ->willReturn($viewConfiguration);

        $extension = new RoutingExtension($generator, $configuration);
        $this->assertEquals('/path/to/page', $extension->getOpPath(new TestUnitPage(), 'view'));
    }

    /**
     * Test getFunctions
     */
    public function testGetFunction()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationChainInterface');
        $extension = new RoutingExtension($generator, $configuration);

        $functions = $extension->getFunctions();
        $this->assertEquals(1, count($functions));

        $this->assertEquals('op_path_page', $functions[0]->getName());
        $callable = $functions[0]->getCallable();
        $this->assertTrue(method_exists($extension, $callable[1]));
    }

    /**
     * Test getName
     */
    public function testGetName()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationChainInterface');
        $extension = new RoutingExtension($generator, $configuration);

        $this->assertEquals('opsite_builder_routing_extension', $extension->getName());
    }
}
