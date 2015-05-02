<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Twig;

use LpFactory\Bundle\CoreBundle\Routing\Configuration\PageRouteConfigurationChainInterface;
use Symfony\Bridge\Twig\Extension\RoutingExtension as BaseRoutingExtension;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class RoutingExtension
 *
 * @package LpFactory\Bundle\CoreBundle\Twig
 * @author jobou
 */
class RoutingExtension extends BaseRoutingExtension
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $opGenerator;

    /**
     * @var PageRouteConfigurationChainInterface
     */
    protected $routeConfiguration;

    /**
     * Constructor
     *
     * @param UrlGeneratorInterface                $generator
     * @param PageRouteConfigurationChainInterface $routeConfiguration
     */
    public function __construct(
        UrlGeneratorInterface $generator,
        PageRouteConfigurationChainInterface $routeConfiguration
    ) {
        parent::__construct($generator);

        $this->opGenerator = $generator;
        $this->routeConfiguration = $routeConfiguration;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'op_path_page',
                array($this, 'getOpPath'),
                array('is_safe_callback' => array($this, 'isUrlGenerationSafe'))
            )
        );
    }

    /**
     * Build op page route
     *
     * @param AbstractPage $page
     * @param string       $action
     * @param array        $parameters
     * @param bool         $relative
     *
     * @return string
     */
    public function getOpPath(AbstractPage $page, $action, $parameters = array(), $relative = false)
    {
        $configuration = $this->routeConfiguration->get($action);

        return $this->opGenerator->generate(
            $configuration->getPageRouteName($page),
            $parameters,
            $relative ? UrlGeneratorInterface::RELATIVE_PATH : UrlGeneratorInterface::ABSOLUTE_PATH
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'lp_factory_routing_extension';
    }
}
