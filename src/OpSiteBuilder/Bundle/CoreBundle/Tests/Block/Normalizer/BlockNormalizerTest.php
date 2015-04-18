<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Normalizer;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\DefaultConfiguration;
use OpSiteBuilder\Bundle\CoreBundle\Block\Normalizer\BlockNormalizer;
use OpSiteBuilder\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class BlockNormalizerTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Normalizer
 * @author jobou
 */
class BlockNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test normalize
     */
    public function testNormalize()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $generator->expects($this->at(0))->method('generate')->willReturn('view_block_url');
        $generator->expects($this->at(1))->method('generate')->willReturn('view_editable_block_url');
        $generator->expects($this->at(2))->method('generate')->willReturn('edit_block_url');
        $generator->expects($this->at(3))->method('generate')->willReturn('remove_block_url');

        $defaultConfiguration = new DefaultConfiguration();
        $configuration = $this->getMock(
            'OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface'
        );
        $configuration
            ->expects($this->once())
            ->method('getConfiguration')
            ->willReturn($defaultConfiguration);

        $normalizer = new BlockNormalizer($generator, $configuration);

        $result = array(
            'id' => null,
            'title' => 'Test block',
            'sort' => 1,
            'type' => 'test_unit',
            'created' => null,
            'updated' => null,
            'actions' => array(
                'view' => 'view_block_url',
                'view_editable' => 'view_editable_block_url',
                'edit' => 'edit_block_url',
                'remove' => 'remove_block_url'
            )
        );

        $normalizedBlock = $normalizer->normalize(PageBlockHelper::createBlock());
        $this->assertEquals($result, $normalizedBlock);
    }

    /**
     * Test supportsNormalization
     */
    public function testSupportsNormalization()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $configuration = $this->getMock(
            'OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface'
        );

        $normalizer = new BlockNormalizer($generator, $configuration);
        $this->assertTrue($normalizer->supportsNormalization(PageBlockHelper::createBlock()));
        $this->assertFalse($normalizer->supportsNormalization(PageBlockHelper::createPageWithBlock()));
    }
}
