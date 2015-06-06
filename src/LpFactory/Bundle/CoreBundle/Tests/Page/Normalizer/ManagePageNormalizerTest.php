<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Page\Normalizer;

use LpFactory\Bundle\CoreBundle\Page\Normalizer\ManagePageNormalizer;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class ManagePageNormalizerTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Page\Normalizer
 * @author jobou
 */
class ManagePageNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test normalize
     */
    public function testPostNormalize()
    {
        $generator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $generator->expects($this->any())->method('generate')->willReturn('one_url');

        $lpGenerator = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $lpGenerator->expects($this->any())->method('generate')->willReturn('dynamic_url');

        $configuration = $this
            ->getMock('LpFactory\Bundle\NestedSetRoutingBundle\Configuration\AbstractPageRouteConfiguration');
        $configuration->expects($this->any())->method('getPageRouteName')->willReturn('string');

        $routeConfiguration = $this
            ->getMock('LpFactory\Bundle\NestedSetRoutingBundle\Configuration\PageRouteConfigurationChainInterface');
        $routeConfiguration
            ->expects($this->any())
            ->method('all')
            ->willReturn(array('view' => $configuration, 'edit' => $configuration));

        $normalizer = new ManagePageNormalizer($generator, $lpGenerator, $routeConfiguration);

        $result = array(
            'actions' => array(
                'load_tree' => 'one_url',
                'view' => 'dynamic_url',
                'edit' => 'dynamic_url'
            ),
            'text' => 'Title',
            'parent' => '#'
        );

        $normalizedPage = array();
        $normalizer->postNormalize($normalizedPage, PageBlockHelper::createPageWithBlock());
        $this->assertEquals($result, $normalizedPage);
    }
}
