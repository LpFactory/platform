<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Routing\Satinizer;

/**
 * Interface UrlSatinizerChainInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Routing\Satinizer
 * @author jobou
 */
interface UrlSatinizerChainInterface
{
    /**
     * Add a satinizer
     *
     * @param UrlSatinizerInterface $satinizer
     */
    public function addSatinizer(UrlSatinizerInterface $satinizer);

    /**
     * Clean the url
     *
     * @param string $url
     *
     * @return string
     */
    public function clean($url);
}
