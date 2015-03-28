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
 * Class UrlSatinizerChain
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Satinizer
 * @author jobou
 */
class UrlSatinizerChain implements UrlSatinizerChainInterface
{
    /**
     * @var array
     */
    protected $satinizers = array();

    /**
     * {@inheritdoc}
     */
    public function addSatinizer(UrlSatinizerInterface $satinizer)
    {
        $this->satinizers[] = $satinizer;
    }

    /**
     * {@inheritdoc}
     */
    public function clean($url)
    {
        /** @var UrlSatinizerInterface $satinizer */
        foreach ($this->satinizers as $satinizer) {
            $url = $satinizer->clean($url);
        }

        return $url;
    }
}
