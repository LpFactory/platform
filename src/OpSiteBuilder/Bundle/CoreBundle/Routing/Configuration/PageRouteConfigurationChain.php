<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration;

use IteratorAggregate;
use ArrayIterator;

/**
 * Class PageRouteConfigurationChain
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration
 * @author jobou
 */
class PageRouteConfigurationChain implements PageRouteConfigurationChainInterface, IteratorAggregate
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

    /**
     * {@inheritdoc}
     */
    public function supports($name)
    {
        /** @var PageRouteConfigurationInterface $configuration */
        foreach ($this->all() as $configuration) {
            if ($configuration->supports($name)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->configurations);
    }
}
