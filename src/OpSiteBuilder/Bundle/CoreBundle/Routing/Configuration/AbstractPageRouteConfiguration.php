<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class AbstractPageRouteConfiguration
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration
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
        if (!$this->getRegex()) {
            return $url;
        }

        if (preg_match($this->getRegex(), $url, $matches)) {
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
        return sprintf('%s%s', $this->getPrefix(), $page->getId());
    }

    /**
     * Build a path
     *
     * @param string $pathInfo
     *
     * @return string
     */
    public function buildPath($pathInfo)
    {
        if (null === $this->getPath()) {
            return $pathInfo;
        }

        return sprintf($this->getPath(), $pathInfo);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($name)
    {
        return strpos($name, $this->getPrefix()) === 0;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getPrefix();

    /**
     * {@inheritdoc}
     */
    abstract public function getRegex();

    /**
     * {@inheritdoc}
     */
    abstract public function getController();

    /**
     * {@inheritdoc}
     */
    abstract public function getPath();
}
