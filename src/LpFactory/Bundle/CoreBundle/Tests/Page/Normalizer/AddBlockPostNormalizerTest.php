<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Page\Normalizer;

use LpFactory\Bundle\CoreBundle\Page\Normalizer\AddBlockPostNormalizer;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class AddBlockPostNormalizerTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Page\Normalizer
 * @author jobou
 */
class AddBlockPostNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test normalize
     */
    public function testPostNormalize()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $generator->expects($this->any())->method('generate')->willReturn('one_url');

        $normalizer = new AddBlockPostNormalizer($generator);

        $result = array(
            'actions' => array(
                'add_block' => 'one_url'
            ),
        );

        $normalizedPage = array();
        $normalizer->postNormalize($normalizedPage, PageBlockHelper::createPageWithBlock());
        $this->assertEquals($result, $normalizedPage);
    }
}
