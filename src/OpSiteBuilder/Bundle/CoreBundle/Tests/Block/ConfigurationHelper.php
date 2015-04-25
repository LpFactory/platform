<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Block;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfiguration;

/**
 * Class ConfigurationHelper
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Block
 * @author jobou
 */
class ConfigurationHelper
{
    /**
     * Create a configuration for test units
     *
     * @return BlockConfiguration
     */
    public static function getConfiguration()
    {
        return new BlockConfiguration(array(
            'view_template'   => 'OpSiteBuilderWebBundle:Block:View/default_view.html.twig',
            'view_controller' => 'OpSiteBuilderCoreBundle:Block:default',
            'view_route'      => 'opsite_builder_api_view_block',
            'edit_controller' => 'OpSiteBuilderCoreBundle:Block:defaultEdit',
            'edit_route'      => 'opsite_builder_api_edit_no_form_block',
            'edit_template'   => 'OpSiteBuilderWebBundle:Block:View/default_edit.html.twig',
            'edit_form_type'  => null,
            'options'         => array()
        ));
    }
}
