<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Renderer;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\DefaultConfiguration;
use OpSiteBuilder\Bundle\CoreBundle\Block\Rendered\BlockRenderer;
use OpSiteBuilder\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class BlockRendererTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Renderer
 * @author jobou
 */
class BlockRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test renderView
     */
    public function testRenderView()
    {
        $blockManager = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface');
        $blockManager
            ->expects($this->once())
            ->method('getData')
            ->willReturn(null);

        $defaultConfiguration = new DefaultConfiguration();
        $blockConfiguration = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface');
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
