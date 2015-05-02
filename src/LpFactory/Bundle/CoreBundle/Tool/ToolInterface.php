<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tool;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface ToolInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Tool
 * @author jobou
 */
interface ToolInterface
{
    /**
     * Is tool enabled
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Check if tool supports page
     *
     * @param AbstractPage $page
     */
    public function supportsPage(AbstractPage $page);

    /**
     * Get the priority of the tool
     *
     * @return int
     */
    public function getPriority();

    /**
     * Get the directive for angular
     *
     * @return string
     */
    public function getDirective();

    /**
     * Get the directive attributes for angular
     *
     * @return array
     */
    public function getDirectiveAttributes();
}
