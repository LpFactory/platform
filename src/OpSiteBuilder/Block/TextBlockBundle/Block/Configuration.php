<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Block\TextBlockBundle\Block;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\DefaultConfiguration;

/**
 * Class Configuration
 *
 * @package OpSiteBuilder\Block\TextBlockBundle\Block
 * @author jobou
 */
class Configuration extends DefaultConfiguration
{
    /**
     * {@inheritdoc}
     */
    public function getViewTemplate()
    {
        return 'OpSiteBuilderTextBlockBundle::view.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getEditRoute()
    {
        return 'opsite_builder_api_edit_form_block';
    }

    /**
     * {@inheritdoc}
     */
    public function getEditTemplate()
    {
        return 'OpSiteBuilderTextBlockBundle::edit.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getEditFormType()
    {
        return 'block_text';
    }
}
