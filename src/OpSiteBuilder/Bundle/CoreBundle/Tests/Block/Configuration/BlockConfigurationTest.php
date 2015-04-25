<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Configuration;

use OpSiteBuilder\Bundle\CoreBundle\Tests\Block\ConfigurationHelper;

/**
 * Class DefaultConfigurationTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Configuration
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
            'OpSiteBuilderWebBundle:Block:View/default_edit.html.twig',
            $configuration->getEditTemplate()
        );
        $this->assertEquals(
            'OpSiteBuilderWebBundle:Block:View/default_view.html.twig',
            $configuration->getViewTemplate()
        );
        $this->assertEquals('OpSiteBuilderCoreBundle:Block:defaultEdit', $configuration->getEditController());
        $this->assertEquals(null, $configuration->getEditFormType());
        $this->assertEquals('opsite_builder_api_edit_no_form_block', $configuration->getEditRoute());
        $this->assertEquals('OpSiteBuilderCoreBundle:Block:default', $configuration->getViewController());
        $this->assertEquals('opsite_builder_api_view_block', $configuration->getViewRoute());
    }
}
