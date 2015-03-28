<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Satinizer;

/**
 * Interface UrlSatinizerChainInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Satinizer
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
