<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Configuration;

/**
 * Interface BlockConfigurationInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
interface BlockConfigurationInterface
{
    /**
     * Get the view controller for a block
     *
     * @return string
     */
    public function getViewController();

    /**
     * Get the view route for a block
     *
     * @return string
     */
    public function getViewRoute();

    /**
     * Get the view template
     *
     * @return string
     */
    public function getViewTemplate();

    /**
     * Get the edit controller for a block
     *
     * @return string
     */
    public function getEditController();

    /**
     * Get the route for this block edition
     *
     * @return string
     */
    public function getEditRoute();

    /**
     * Get the edit template
     *
     * @return string
     */
    public function getEditTemplate();

    /**
     * Get the edit form type
     *
     * @return string|null
     */
    public function getEditFormType();
}
