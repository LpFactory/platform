<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Normalizer;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMapChain;
use LpFactory\Bundle\CoreBundle\Block\Normalizer\BlockMapChainNormalizer;
use LpFactory\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;

/**
 * Class BlockMapChainNormalizerTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block\Normalizer
 * @author jobou
 */
class BlockMapChainNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test normalize and supportsNormalization
     */
    public function testNormalizeAndSupport()
    {
        $normalizer = $this->getMock('Symfony\Component\Serializer\Normalizer\NormalizerInterface');
        $normalizer
            ->expects($this->exactly(3))
            ->method('normalize')
            ->willReturn(array());

        $normalizer = new BlockMapChainNormalizer($normalizer);

        $blockMapChain = ConfigurationHelper::createBlockMapChain();

        $this->assertEquals(
            array('test1' => array(), 'test2' => array(), 'test3' => array()),
            $normalizer->normalize($blockMapChain)
        );

        $this->assertEquals(false, $normalizer->supportsNormalization(null));
        $this->assertEquals(true, $normalizer->supportsNormalization($blockMapChain));
    }
}
