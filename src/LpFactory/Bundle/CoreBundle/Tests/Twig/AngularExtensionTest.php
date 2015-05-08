<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Twig;

use LpFactory\Bundle\CoreBundle\Twig\AngularExtension;

/**
 * Class AngularExtensionTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Twig
 * @author jobou
 */
class AngularExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test toHtmlAttributes
     */
    public function testToHtmlAttributes()
    {
        $attributes = array(
            'type' => 'text',
            'id' => 'html_id'
        );
        $extension = new AngularExtension();
        $this->assertEquals('type="text" id="html_id"', $extension->toHtmlAttributes($attributes));
    }

    /**
     * Test getFilters
     */
    public function testGetFilters()
    {
        $extension = new AngularExtension();
        $filters = $extension->getFilters();
        $this->assertEquals(1, count($filters));

        $filterNames = array(
            'to_html_attributes'
        );
        foreach ($filters as $key => $filter) {
            $this->assertEquals($filterNames[$key], $filter->getName());
            $callable = $filter->getCallable();
            $this->assertTrue(method_exists($extension, $callable[1]));
        }
    }

    /**
     * Test getName
     */
    public function testGetName()
    {
        $extension = new AngularExtension();
        $this->assertEquals('lp_factory_angular_extension', $extension->getName());
    }
}
