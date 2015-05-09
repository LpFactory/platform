<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Normalizer;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMap;
use LpFactory\Bundle\CoreBundle\Block\Normalizer\BlockMapNormalizer;
use LpFactory\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;

/**
 * Class BlockMapNormalizerTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block\Normalizer
 * @author jobou
 */
class BlockMapNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test all getter
     */
    public function testGetter()
    {
        $translator = $this->getMock('Symfony\Component\Translation\TranslatorInterface');

        $translator
            ->expects($this->exactly(2))
            ->method('trans')
            ->will($this->onConsecutiveCalls('Label1', 'Text1'));


        $normalizer = new BlockMapNormalizer($translator);
        $this->assertEquals(
            array(
                'label' => 'Label1',
                'picto' => 'Picto1',
                'text'  => 'Text1'
            ),
            $normalizer->normalize(ConfigurationHelper::createBlockMap())
        );

        $this->assertEquals(false, $normalizer->supportsNormalization(null));
        $this->assertEquals(true, $normalizer->supportsNormalization(ConfigurationHelper::createBlockMap()));
    }
}
