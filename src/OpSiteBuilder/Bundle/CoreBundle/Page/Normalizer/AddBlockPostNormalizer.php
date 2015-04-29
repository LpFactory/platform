<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Page\Normalizer;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AddBlockPostNormalizer
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Page\Normalizer
 * @author jobou
 */
class AddBlockPostNormalizer implements ToolPostNormalizerInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;

    /**
     * Constructor
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Add add_block route to page
     *
     * @param array        $normalizedData
     * @param AbstractPage $page
     */
    public function postNormalize(array &$normalizedData, AbstractPage $page)
    {
        $normalizedData['actions']['add_block'] = $this->urlGenerator->generate(
            'opsite_builder_api_add_block_to_page',
            array(
                'id' => $page->getId(),
                'type' => PageNormalizer::BLOCK_TYPE_PLACEHOLDER
            )
        );
    }
}
