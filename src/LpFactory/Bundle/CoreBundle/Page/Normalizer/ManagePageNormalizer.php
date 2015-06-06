<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace LpFactory\Bundle\CoreBundle\Page\Normalizer;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use LpFactory\Bundle\NestedSetRoutingBundle\Configuration\PageRouteConfigurationChainInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ManagePageNormalizer
 *
 * @package LpFactory\Bundle\CoreBundle\Page\Normalizer
 * @author jobou
 */
class ManagePageNormalizer implements ToolPostNormalizerInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $lpUrlGenerator;

    /**
     * @var UrlGeneratorInterface
     */
    protected $generator;

    /**
     * @var PageRouteConfigurationChainInterface
     */
    protected $routeConfiguration;

    /**
     * @var array
     */
    protected $toolNormalizers = array();

    /**
     * Constructor
     *
     * @param UrlGeneratorInterface                $generator
     * @param UrlGeneratorInterface                $lpUrlGenerator
     * @param PageRouteConfigurationChainInterface $routeConfiguration
     */
    public function __construct(
        UrlGeneratorInterface $generator,
        UrlGeneratorInterface $lpUrlGenerator,
        PageRouteConfigurationChainInterface $routeConfiguration
    ) {
        $this->generator = $generator;
        $this->lpUrlGenerator = $lpUrlGenerator;
        $this->routeConfiguration = $routeConfiguration;
    }

    /**
     * Add jstree parameters and page route
     *
     * @param array        $normalizedData
     * @param AbstractPage $page
     */
    public function postNormalize(array &$normalizedData, AbstractPage $page)
    {
        if (!isset($normalizedData['actions'])) {
            $normalizedData['actions'] = array();
        }

        $normalizedData['actions']['load_tree'] = $this->generator->generate(
            'lp_factory_api_page_list',
            array('id' => $page->getId())
        );

        /** @var AbstractPageRouteConfiguration $configuration */
        foreach ($this->routeConfiguration->all() as $type => $configuration) {
            $normalizedData['actions'][$type] = $this->lpUrlGenerator->generate(
                $configuration->getPageRouteName($page)
            );
        }

        // Used by jstree
        $normalizedData['text'] = $page->getTitle();
        $normalizedData['parent'] = $page->getParent() !== null ? $page->getParent()->getId() : "#";
    }
}
