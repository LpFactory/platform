<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\Configuration;

use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\AbstractPageRouteConfiguration;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationChain;

/**
 * Class PageRouteConfigurationChainTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\Configuration
 * @author jobou
 */
class PageRouteConfigurationChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PageRouteConfigurationChain
     */
    protected $configurationChain;

    /**
     * Set up a route configuration chain
     */
    public function setUp()
    {
        $this->configurationChain = new PageRouteConfigurationChain(
            'OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfiguration'
        );

        $this->configurationChain->add(
            'edit',
            array(
                'prefix' => 'opsite_page_tree_edit_',
                'regex' => '/(.+)\/edit$/',
                'controller' => 'OpSiteBuilderCoreBundle:Page:edit',
                'path' => '%s/edit'
            )
        );

        $this->configurationChain->add(
            'view',
            array(
                'prefix' => 'opsite_page_tree_view_',
                'regex' => null,
                'controller' => 'OpSiteBuilderCoreBundle:Page:index'
            )
        );
    }

    /**
     * Test unknown configuration
     *
     * @expectedException \LogicException
     */
    public function testUnknownConfiguration()
    {
        $this->configurationChain->get('test');
    }

    /**
     * Test configuration getter
     */
    public function testConfigurationGetter()
    {
        $configuration = $this->configurationChain->get('view');
        $this->validateViewConfiguration($configuration);

        $configuration = $this->configurationChain->getConfigurationByRouteName('opsite_page_tree_view_56');
        $this->validateViewConfiguration($configuration);
        $configuration = $this->configurationChain->getConfigurationByRouteName('opsite_page_tree_remove_56');
        $this->assertNull($configuration);

        $configuration = $this->configurationChain->getConfigurationByPathInfo('/child1/child2');
        $this->validateViewConfiguration($configuration);
    }

    /**
     * Test supports
     */
    public function testSupports()
    {
        $this->assertTrue($this->configurationChain->supports('opsite_page_tree_view_56'));
        $this->assertFalse($this->configurationChain->supports('opsite_page_tree_remove_56'));
    }

    /**
     * Validate it is a view configuration
     *
     * @param AbstractPageRouteConfiguration $configuration
     */
    protected function validateViewConfiguration(AbstractPageRouteConfiguration $configuration)
    {
        $this->assertEquals($configuration->getPath(), null);
        $this->assertEquals($configuration->getPrefix(), 'opsite_page_tree_view_');
        $this->assertEquals($configuration->getRegex(), null);
        $this->assertEquals($configuration->getController(), 'OpSiteBuilderCoreBundle:Page:index');
    }

    /**
     * Test getIterator
     */
    public function testGetIterator()
    {
        $this->assertInstanceOf('\ArrayIterator', $this->configurationChain->getIterator());
    }
}
