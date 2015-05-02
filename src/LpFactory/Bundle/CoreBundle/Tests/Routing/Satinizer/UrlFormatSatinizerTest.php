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

/**
 * Class UrlFormatSatinizerTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Routing\Satinizer
 * @author jobou
 */
class UrlFormatSatinizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test clean
     */
    public function testClean()
    {
        $satinizer = new UrlFormatSatinizer();
        $this->assertEquals('/child1/child2/child3', $satinizer->clean('/child1/child2/child3.json'));
        $this->assertEquals('/child1/child2/child3', $satinizer->clean('/child1/child2/child3'));
    }
}
