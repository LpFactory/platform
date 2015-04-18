<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Provider;

use OpSiteBuilder\Bundle\CoreBundle\Block\Provider\DefaultDataProvider;
use OpSiteBuilder\Bundle\CoreBundle\Tests\PageBlockHelper;

/**
 * Class DefaultDataProviderTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Provider
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
