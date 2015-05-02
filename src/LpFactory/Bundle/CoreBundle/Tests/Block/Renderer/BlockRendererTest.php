<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Renderer;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockConfiguration;
use LpFactory\Bundle\CoreBundle\Block\Rendered\BlockRenderer;
use LpFactory\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class BlockRendererTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block\Renderer
 * @author jobou
 */
class BlockRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test renderView
     */
    public function testRenderView()
    {
        $blockManager = $this->getMock('LpFactory\Bundle\CoreBundle\Block\BlockManagerInterface');
        $blockManager
            ->expects($this->once())
            ->method('getData')
            ->willReturn(null);

        $defaultConfiguration = ConfigurationHelper::getConfiguration();
        $blockConfiguration = $this
            ->getMock('LpFactory\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');
        $blockConfiguration
            ->expects($this->once())
            ->method('getConfiguration')
            ->willReturn($defaultConfiguration);

        $templating = $this->getMock('Symfony\Component\Templating\EngineInterface');
        $templating
            ->expects($this->once())
            ->method('render')
            ->willReturn('Template for block');

        $renderer = new BlockRenderer($blockManager, $blockConfiguration, $templating);
        $this->assertEquals('Template for block', $renderer->renderView(PageBlockHelper::createBlock()));

    }
}
