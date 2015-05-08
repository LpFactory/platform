<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Tool;

use LpFactory\Bundle\CoreBundle\Tool\Tool;
use LpFactory\Bundle\CoreBundle\Tool\ToolChain;

/**
 * Class ToolHelper
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Tool
 * @author jobou
 */
class ToolHelper
{
    public static function createToolChain()
    {
        $toolChain = new ToolChain();
        $toolChain->addTool(static::createTool(), 'tool1');
        $toolChain->addTool(static::createTool(3), 'tool3');
        $toolChain->addTool(static::createTool(2), 'tool2');

        return $toolChain;
    }
    /**
     * Create tool
     *
     * @param int $suffix
     *
     * @return Tool
     */
    public static function createTool($suffix = 1)
    {
        return new Tool(array(
            'directive' => 'directive'.$suffix,
            'directive_attributes' => array(
                'attribute1' => 'value1',
                'attribute2' => 'value2',
            ),
            'enabled' => true,
            'pages' => array(
                'LpFactory\Bundle\CoreBundle\Tests\Entity\TestUnitPage'
            ),
            'priority' => $suffix
        ));
    }
}
