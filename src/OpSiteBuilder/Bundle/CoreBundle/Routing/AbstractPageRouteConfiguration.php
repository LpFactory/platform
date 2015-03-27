<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class AbstractPageRouteConfiguration
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
abstract class AbstractPageRouteConfiguration implements PageRouteConfigurationInterface
{
    /**
     * Check if route configuration matches url
     *
     * @param string $url
     *
     * @return null|string
     */
    public function isMatching($url)
    {
        if (!$this->getMatchingRegex()) {
            return $url;
        }

        if (preg_match($this->getMatchingRegex(), $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Get page route name
     *
     * @param AbstractPage $page
     *
     * @return string
     */
    public function getPageRouteName(AbstractPage $page)
    {
        return sprintf('%s%s', $this->getRoutePrefix(), $page->getId());
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getRoutePrefix();

    /**
     * {@inheritdoc}
     */
    abstract public function getMatchingRegex();

    /**
     * {@inheritdoc}
     */
    abstract public function getController();
}
