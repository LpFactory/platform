<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Routing;

use OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration\PageRouteConfiguration;

/**
 * Class RoutingHelper
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Routing
 * @author jobou
 */
class RoutingHelper
{
    /**
     * Create view route configuration
     *
     * @return PageRouteConfiguration
     */
    public static function createViewConfiguration()
    {
        return new PageRouteConfiguration(
            array(
                'prefix' => 'opsite_page_tree_view_',
                'regex' => null,
                'controller' => 'OpSiteBuilderCoreBundle:Page:index'
            )
        );
    }

    /**
     * Create edit route configuration
     *
     * @return PageRouteConfiguration
     */
    public static function createEditConfiguration()
    {
        return new PageRouteConfiguration(
            array(
                'prefix' => 'opsite_page_tree_edit_',
                'regex' => '/(.+)\/edit$/',
                'controller' => 'OpSiteBuilderCoreBundle:Page:edit',
                'path' => '%s/edit'
            )
        );
    }
}
