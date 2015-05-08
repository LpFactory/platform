<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Page\Normalizer;

use LpFactory\Bundle\CoreBundle\Page\Normalizer\AddBlockPostNormalizer;
use LpFactory\Bundle\CoreBundle\Page\Normalizer\PageNormalizer;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class PageNormalizerTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Page\Normalizer
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
        $generator->expects($this->any())->method('generate')->willReturn('move_block_url');

        $blockNormalizer = $this->getMock('Symfony\Component\Serializer\Normalizer\NormalizerInterface');

        $normalizer = new PageNormalizer($blockNormalizer, $generator);

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

        // Add post normalizer
        $generatorMock = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $generatorMock->expects($this->at(0))->method('generate')->willReturn('add_block_url');
        $normalizer->addToolNormalizer(new AddBlockPostNormalizer($generatorMock));
        $result['actions']['add_block'] = 'add_block_url';
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
