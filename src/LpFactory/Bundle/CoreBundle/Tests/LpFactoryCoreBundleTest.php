<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Tests;

use LpFactory\Bundle\CoreBundle\LpFactoryCoreBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class LpFactoryCoreBundleTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests
 * @author jobou
 */
class LpFactoryCoreBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test build
     */
    public function testBuild()
    {
        $container = new ContainerBuilder();
        $onCreatePassNb = count($container->getCompilerPassConfig()->getPasses());

        $bundle = new LpFactoryCoreBundle();
        $bundle->build($container);

        $this->assertEquals($onCreatePassNb + 3, count($container->getCompilerPassConfig()->getPasses()));
    }
}
