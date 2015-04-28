<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Twig;

use OpSiteBuilder\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;
use OpSiteBuilder\Bundle\CoreBundle\Tests\Entity\TestUnitBlock;
use OpSiteBuilder\Bundle\CoreBundle\Twig\BlockExtension;

/**
 * Class BlockExtensionTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Twig
 * @author jobou
 */
class BlockExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getBlockViewController
     */
    public function testGetBlockViewController()
    {
        $manager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');

        $defaultConfiguration = ConfigurationHelper::getConfiguration();

        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');
        $configuration
            ->expects($this->once())
            ->method('getConfiguration')
            ->willReturn($defaultConfiguration);

        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface');

        $extension = new BlockExtension($configuration, $manager, $blockChainMock);

        $this->assertEquals(
            $defaultConfiguration->getViewController(),
            $extension->getBlockViewController(new TestUnitBlock())
        );
    }

    /**
     * Test getBlockEditRoute
     */
    public function testGetBlockEditRoute()
    {
        $manager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');

        $defaultConfiguration = ConfigurationHelper::getConfiguration();

        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');
        $configuration
            ->expects($this->once())
            ->method('getConfiguration')
            ->willReturn($defaultConfiguration);

        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface');

        $extension = new BlockExtension($configuration, $manager, $blockChainMock);

        $this->assertEquals($defaultConfiguration->getEditRoute(), $extension->getBlockEditRoute(new TestUnitBlock()));
    }

    /**
     * Test isBlockEmpty
     */
    public function testIsBlockEmpty()
    {
        $manager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');
        $manager
            ->expects($this->once())
            ->method('isEmpty')
            ->willReturn(true);

        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');

        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface');

        $extension = new BlockExtension($configuration, $manager, $blockChainMock);

        $this->assertTrue($extension->isBlockEmpty(new TestUnitBlock()));
    }

    /**
     * Test getBlockTypes
     */
    public function testGetBlockTypes()
    {
        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface');
        $blockChainMock
            ->expects($this->once())
            ->method('keys')
            ->willReturn(array('text', 'gallery'));

        $manager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');
        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');

        $extension = new BlockExtension($configuration, $manager, $blockChainMock);

        $this->assertEquals(array('text', 'gallery'), $extension->getBlockTypes());
    }

    /**
     * Test getFunctions
     */
    public function testGetFunction()
    {
        $manager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');
        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');
        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface');
        $extension = new BlockExtension($configuration, $manager, $blockChainMock);

        $functions = $extension->getFunctions();
        $this->assertEquals(4, count($functions));

        $functionNames = array(
            'get_block_view_controller',
            'get_block_edit_route',
            'block_is_empty',
            'get_block_types'
        );
        foreach ($functions as $key => $function) {
            $this->assertEquals($functionNames[$key], $function->getName());
            $callable = $functions[0]->getCallable();
            $this->assertTrue(method_exists($extension, $callable[1]));
        }
    }

    /**
     * Test getName
     */
    public function testGetName()
    {
        $manager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');
        $configuration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');
        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface');
        $extension = new BlockExtension($configuration, $manager, $blockChainMock);

        $this->assertEquals('opsite_builder_block_extension', $extension->getName());
    }
}
