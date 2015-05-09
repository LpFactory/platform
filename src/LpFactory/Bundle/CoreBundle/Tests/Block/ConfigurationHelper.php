<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Block;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockConfiguration;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMap;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMapChain;

/**
 * Class ConfigurationHelper
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Block
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
            'view_template'   => 'LpFactoryCoreBundle:Block:View/default_view.html.twig',
            'view_controller' => 'LpFactoryCoreBundle:Block:default',
            'view_route'      => 'lp_factory_api_view_block',
            'edit_controller' => 'LpFactoryCoreBundle:Block:defaultEdit',
            'edit_route'      => 'lp_factory_api_edit_no_form_block',
            'edit_template'   => 'LpFactoryCoreBundle:Block:View/default_edit.html.twig',
            'edit_form_type'  => null,
            'options'         => array(
                'custom' => 'my_value'
            )
        ));
    }

    /**
     * Create a block map chain
     *
     * @param int $number
     *
     * @return BlockMapChain
     */
    public static function createBlockMapChain($number = 3)
    {
        $blockMapChain = new BlockMapChain();
        for ($i = 1; $i < $number + 1; $i++) {
            $blockMapChain->addMap(static::createBlockMap($i), 'test'.$i);
        }

        return $blockMapChain;
    }

    /**
     * Create a block map
     *
     * @param int $suffix
     *
     * @return BlockMap
     */
    public static function createBlockMap($suffix = 1)
    {
        return new BlockMap(
            array(
                'class' => 'Test'.$suffix,
                'label' => 'Label'.$suffix,
                'picto' => 'Picto'.$suffix,
                'text'  => 'Text'.$suffix,
            )
        );
    }
}
