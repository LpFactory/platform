<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Tool;

use LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitBisPage;
use LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitPage;
use LpFactory\Bundle\CoreBundle\Tool\Tool;

/**
 * class ToolTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Tool
 * @author jobou
 */
class ToolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test all getter
     */
    public function testGetter()
    {
        $tool = ToolHelper::createTool();
        $this->assertEquals('directive1', $tool->getDirective());
        $this->assertEquals(true, $tool->isEnabled());
        $this->assertEquals(1, $tool->getPriority());
        $this->assertEquals(
            array(
                'attribute1' => 'value1',
                'attribute2' => 'value2',
            ),
            $tool->getDirectiveAttributes()
        );
        $this->assertEquals(true, $tool->supportsPage(new TestUnitPage()));
        $this->assertEquals(false, $tool->supportsPage(new TestUnitBisPage()));

        $toolWithoutPages = new Tool(array(
            'directive' => 'directive',
            'directive_attributes' => array(
                'attribute1' => 'value1',
                'attribute2' => 'value2',
            ),
            'enabled' => true,
            'pages' => array(),
            'priority' => 1
        ));
        $this->assertEquals(true, $toolWithoutPages->supportsPage(new TestUnitBisPage()));
    }
}
