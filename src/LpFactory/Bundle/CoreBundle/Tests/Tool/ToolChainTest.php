<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Tool;

use LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitPage;
use LpFactory\Bundle\CoreBundle\Tool\Tool;
use LpFactory\Bundle\CoreBundle\Tool\ToolChain;

/**
 * Class ToolChainTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Tool
 * @author jobou
 */
class ToolChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test all
     */
    public function testAll()
    {
        $toolChain = ToolHelper::createToolChain();
        $this->assertEquals(3, count($toolChain->all()));
    }

    /**
     * Test sortTools
     */
    public function testSortTools()
    {
        $toolChain = ToolHelper::createToolChain();
        $toolWithIdenticalPriority = new Tool(array(
            'directive' => 'directive',
            'directive_attributes' => array(
                'attribute1' => 'value1',
                'attribute2' => 'value2',
            ),
            'enabled' => true,
            'pages' => array(
                'LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitBisPage'
            ),
            'priority' => 3
        ));
        $toolChain->addTool($toolWithIdenticalPriority, 'tool3bis');

        $allKeys = array_keys($toolChain->all());
        $this->assertEquals('tool2', $allKeys[1]);
    }

    /**
     * Test allInPage
     */
    public function testAllInPage()
    {
        $toolChain = ToolHelper::createToolChain();
        $this->assertEquals(3, count($toolChain->allInPage(new TestUnitPage())));

        $toolWithDifferentPage = new Tool(array(
            'directive' => 'directive',
            'directive_attributes' => array(
                'attribute1' => 'value1',
                'attribute2' => 'value2',
            ),
            'enabled' => true,
            'pages' => array(
                'LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitBisPage'
            ),
            'priority' => 5
        ));
        $toolChain->addTool($toolWithDifferentPage, 'tool5');
        $this->assertEquals(3, count($toolChain->allInPage(new TestUnitPage())));
    }
}
