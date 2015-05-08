<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block\Configuration;

use LpFactory\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;

/**
 * Class DefaultConfigurationTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block\Configuration
 * @author jobou
 */
class BlockConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test all getter
     */
    public function testGetter()
    {
        $configuration = ConfigurationHelper::getConfiguration();
        $this->assertEquals(
            'LpFactoryWebBundle:Block:View/default_edit.html.twig',
            $configuration->getEditTemplate()
        );
        $this->assertEquals(
            'LpFactoryWebBundle:Block:View/default_view.html.twig',
            $configuration->getViewTemplate()
        );
        $this->assertEquals('LpFactoryCoreBundle:Block:defaultEdit', $configuration->getEditController());
        $this->assertEquals(null, $configuration->getEditFormType());
        $this->assertEquals('lp_factory_api_edit_no_form_block', $configuration->getEditRoute());
        $this->assertEquals('LpFactoryCoreBundle:Block:default', $configuration->getViewController());
        $this->assertEquals('lp_factory_api_view_block', $configuration->getViewRoute());
        $this->assertEquals(false, $configuration->hasOption('unknown_key'));
        $this->assertEquals(true, $configuration->hasOption('custom'));

        $this->assertEquals('my_value', $configuration->getOption('custom'));
    }

    /**
     * Test unknown option
     *
     * @expectedException \LpFactory\Bundle\CoreBundle\Block\Exception\UnknownBlockOptionException
     */
    public function testUnknownOption()
    {
        $configuration = ConfigurationHelper::getConfiguration();
        $configuration->getOption('unknown_key');
    }
}
