<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Configuration;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChain;
use OpSiteBuilder\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;

/**
 * Class BlockConfigurationChainTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Configuration
 * @author jobou
 */
class BlockConfigurationChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BlockConfigurationChain
     */
    protected $configurationChain;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $defaultConfiguration = ConfigurationHelper::getConfiguration();

        $this->configurationChain = new BlockConfigurationChain();
        $this->configurationChain->addConfiguration($defaultConfiguration, 'default');
    }

    /**
     * Test addConfiguration
     */
    public function testAddConfiguration()
    {
        $testConfiguration = new TestConfiguration(array(
            'view_template'   => 'OpSiteBuilderWebBundle:Block:View/default_view.html.twig',
            'view_controller' => 'OpSiteBuilderCoreBundle:Block:default',
            'view_route'      => 'opsite_builder_api_view_block',
            'edit_controller' => 'OpSiteBuilderCoreBundle:Block:defaultEdit',
            'edit_route'      => 'opsite_builder_api_edit_no_form_block',
            'edit_template'   => 'OpSiteBuilderWebBundle:Block:View/default_edit.html.twig',
            'edit_form_type'  => null,
            'options'         => array()
        ));

        $this->configurationChain->addConfiguration($testConfiguration, 'test');

        $this->assertInstanceOf(
            'OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Configuration\TestConfiguration',
            $this->configurationChain->getConfiguration('test')
        );
    }

    /**
     * Test getConfiguration return default if none found
     */
    public function testDefaultConfiguration()
    {
        $this->assertInstanceOf(
            'OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfiguration',
            $this->configurationChain->getConfiguration('unknown_type')
        );
    }

    /**
     * @expectedException \LogicException
     */
    public function testDefaultConfigurationExists()
    {
        $configurationChain = new BlockConfigurationChain();
        $configurationChain->getConfiguration('default');
    }
}
