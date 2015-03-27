<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageRouteConfigurationChain
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
class PageRouteConfigurationChain implements PageRouteConfigurationChainInterface
{
    /**
     * @var string
     */
    protected $routeConfigurationClass;

    /**
     * @var array
     */
    protected $configurations = array();

    /**
     * Constructor
     *
     * @param string $routeConfigurationClass
     */
    public function __construct($routeConfigurationClass)
    {
        $this->routeConfigurationClass = $routeConfigurationClass;
    }

    /**
     * {@inheritdoc}
     */
    public function add($alias, array $configuration)
    {
        $routeConfiguration = new $this->routeConfigurationClass($configuration);

        $this->configurations[$alias] = $routeConfiguration;
    }

    /**
     * {@inheritdoc}
     */
    public function get($alias)
    {
        if (!$this->configurations[$alias]) {
            throw new \LogicException('No route configuration for alias : '.$alias);
        }

        return $this->configurations[$alias];
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->configurations;
    }
}
