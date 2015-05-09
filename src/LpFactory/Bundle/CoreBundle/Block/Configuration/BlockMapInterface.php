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
 * Interface BlockMapInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
interface BlockMapInterface
{
    /**
     * Get the class with the code for the block
     *
     * @return string
     */
    public function getClass();

    /**
     * Get the label for the block
     *
     * @return string
     */
    public function getLabel();

    /**
     * Get the class (HTML) to display a picto
     *
     * @return string
     */
    public function getPicto();

    /**
     * Get the description to display what do the block
     *
     * @return string
     */
    public function getText();
}
