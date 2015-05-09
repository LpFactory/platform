<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Configuration;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMap;
use LpFactory\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;

/**
 * Class BlockMapTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block\Configuration
 * @author jobou
 */
class BlockMapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test all getter
     */
    public function testGetter()
    {
        $map = ConfigurationHelper::createBlockMap();
        $this->assertEquals('Test1', $map->getClass());
        $this->assertEquals('Label1', $map->getLabel());
        $this->assertEquals('Picto1', $map->getPicto());
        $this->assertEquals('Text1', $map->getText());
    }

    /**
     * Test unknown option
     *
     * @expectedException Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException
     */
    public function testUnknownOption()
    {
        $map = new BlockMap(array('unknown' => 'value'));
    }
}
