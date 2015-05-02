<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Provider;

use LpFactory\Bundle\CoreBundle\Block\Provider\DefaultDataProvider;
use LpFactory\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class DefaultDataProviderTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block\Provider
 * @author jobou
 */
class DefaultDataProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getData
     */
    public function testGetData()
    {
        $defaultProvider = new DefaultDataProvider();
        $this->assertEquals(array(), $defaultProvider->getData(PageBlockHelper::createBlock()));
    }
}
