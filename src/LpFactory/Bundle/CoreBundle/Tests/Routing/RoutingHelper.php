<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Routing;

use LpFactory\Bundle\CoreBundle\Routing\Configuration\PageRouteConfiguration;

/**
 * Class RoutingHelper
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Routing
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
                'prefix' => 'lpfactory_page_tree_view_',
                'regex' => null,
                'controller' => 'LpFactoryCoreBundle:Page:index'
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
                'prefix' => 'lpfactory_page_tree_edit_',
                'regex' => '/(.+)\/edit$/',
                'controller' => 'LpFactoryCoreBundle:Page:edit',
                'path' => '%s/edit'
            )
        );
    }
}
