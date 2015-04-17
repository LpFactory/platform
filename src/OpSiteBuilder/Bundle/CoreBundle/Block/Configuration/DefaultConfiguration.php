<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Configuration;

/**
 * Class DefaultConfiguration
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
class DefaultConfiguration implements BlockConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getViewController()
    {
        return 'OpSiteBuilderCoreBundle:Block:default';
    }

    /**
     * {@inheritdoc}
     */
    public function getViewRoute()
    {
        return 'opsite_builder_api_view_block';
    }

    /**
     * {@inheritdoc}
     */
    public function getEditRoute()
    {
        return 'opsite_builder_api_edit_block';
    }
}
