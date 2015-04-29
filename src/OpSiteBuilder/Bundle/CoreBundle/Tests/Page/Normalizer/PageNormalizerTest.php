<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Page\Normalizer;

use OpSiteBuilder\Bundle\CoreBundle\Page\Normalizer\PageNormalizer;
use OpSiteBuilder\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class PageNormalizerTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Page\Normalizer
 * @author jobou
 */
class PageNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test normalize
     */
    public function testNormalize()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $generator->expects($this->at(0))->method('generate')->willReturn('move_block_url');

        $normalizer = $this->getMock('Symfony\Component\Serializer\Normalizer\NormalizerInterface');

        $normalizer = new PageNormalizer($normalizer, $generator);

        $result = array(
            'id' => null,
            'title' => 'Title',
            'slug' => 'slug-title',
            'created' => null,
            'updated' => null,
            'actions' => array(
                'move_block' => 'move_block_url'
            ),
            'blocks' => array(null, null, null)
        );

        $normalizedPage = $normalizer->normalize(PageBlockHelper::createPageWithBlock());
        $this->assertEquals($result, $normalizedPage);
    }

    /**
     * Test supportsNormalization
     */
    public function testSupportsNormalization()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $normalizer = $this->getMock('Symfony\Component\Serializer\Normalizer\NormalizerInterface');

        $normalizer = new PageNormalizer($normalizer, $generator);
        $this->assertFalse($normalizer->supportsNormalization(PageBlockHelper::createBlock()));
        $this->assertTrue($normalizer->supportsNormalization(PageBlockHelper::createPageWithBlock()));
    }
}
