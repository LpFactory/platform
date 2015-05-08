<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Page\Configuration;

use LpFactory\Bundle\CoreBundle\Page\Configuration\PageMap;

/**
 * Class PageMapTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Page\Configuration
 * @author jobou
 */
class PageMapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getDiscriminatorMap
     */
    public function testGetDiscriminatorMap()
    {
        $map = array('test' => 'Test');
        $pageMap = new PageMap($map);
        $this->assertEquals($map, $pageMap->getDiscriminatorMap());
    }
}
