<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PageRouteConfiguration
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing\Configuration
 * @author jobou
 */
class PageRouteConfiguration extends AbstractPageRouteConfiguration
{
    /**
     * @var string
     */
    protected $routePrefix;

    /**
     * @var string
     */
    protected $matchingRegex;

    /**
     * @var string
     */
    protected $controller;

    /**
     * Constructor
     *
     * @param array $routeConfiguration
     */
    public function __construct(array $routeConfiguration)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(array(
            'route_prefix',
            'route_regex',
            'controller'
        ));

        $routeConfiguration = $resolver->resolve($routeConfiguration);

        $this->routePrefix = $routeConfiguration['route_prefix'];
        $this->matchingRegex = $routeConfiguration['route_regex'];
        $this->controller = $routeConfiguration['controller'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutePrefix()
    {
        return $this->routePrefix;
    }

    /**
     * {@inheritdoc}
     */
    public function getMatchingRegex()
    {
        return $this->matchingRegex;
    }

    /**
     * {@inheritdoc}
     */
    public function getController()
    {
        return $this->controller;
    }
}
