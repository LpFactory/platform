<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Page\Normalizer;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AddBlockPostNormalizer
 *
 * @package LpFactory\Bundle\CoreBundle\Page\Normalizer
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
        if (!isset($normalizedData['actions'])) {
            $normalizedData['actions'] = array();
        }

        $normalizedData['actions']['add_block'] = $this->urlGenerator->generate(
            'lp_factory_api_add_block_to_page',
            array(
                'id' => $page->getId(),
                'type' => PageNormalizer::BLOCK_TYPE_PLACEHOLDER
            )
        );
    }
}
