<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Routing\Satinizer;

use LpFactory\Bundle\CoreBundle\Routing\Satinizer\UrlFormatSatinizer;
use LpFactory\Bundle\CoreBundle\Routing\Satinizer\UrlSatinizerChain;

/**
 * Class UrlSatinizerChainTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Routing\Satinizer
 * @author jobou
 */
class UrlSatinizerChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test clean
     */
    public function testClean()
    {
        $chain = new UrlSatinizerChain();

        $satinizerMock = $this->getMock('LpFactory\Bundle\CoreBundle\Routing\Satinizer\UrlSatinizerInterface');
        $satinizerMock
            ->expects($this->once())
            ->method('clean')
            ->willReturn('/child1/child2/child3.json');

        $chain->addSatinizer($satinizerMock);
        $chain->addSatinizer(new UrlFormatSatinizer());

        $this->assertEquals('/child1/child2/child3', $chain->clean('/child1/child2/child3.json#test'));
    }
}
