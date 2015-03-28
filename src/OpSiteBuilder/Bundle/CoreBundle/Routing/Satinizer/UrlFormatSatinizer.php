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
 * Class UrlFormatSatinizer
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Satinizer
 * @author jobou
 */
class UrlFormatSatinizer implements UrlSatinizerInterface
{
    /**
     * Remove .{_format} at the end of path info
     *
     * @param string $url
     *
     * @return string
     */
    public function clean($url)
    {
        // handle format extension, like .html or .json
        if (preg_match('/(.+)\.[a-z]+$/i', $url, $matches)) {
            return $matches[1];
        }

        return $url;
    }
}
