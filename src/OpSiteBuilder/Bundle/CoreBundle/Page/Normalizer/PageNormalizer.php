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
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class PageNormalizer
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Page\Normalizer
 * @author jobou
 */
class PageNormalizer implements NormalizerInterface
{
    /**
     * Block type placeholder to be replaced in frontend application
     */
    const BLOCK_TYPE_PLACEHOLDER = '__BLOCK_TYPE__';

    /**
     * Block id placeholder to be replaced in frontend application
     */
    const BLOCK_ID_PLACEHOLDER = '__BLOCK_ID__';

    /**
     * @var NormalizerInterface
     */
    protected $blockNormalize;

    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;

    /**
     * Constructor
     *
     * @param NormalizerInterface   $blockNormalize
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(NormalizerInterface $blockNormalize, UrlGeneratorInterface $urlGenerator)
    {
        $this->blockNormalize = $blockNormalize;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Normalize a page
     *
     * @param AbstractPage  $object
     * @param string        $format
     * @param array         $context
     *
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        // Page entity with routes used in Angular
        $page = array(
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'slug' => $object->getSlug(),
            'created' => $object->getCreated(),
            'updated' => $object->getUpdated(),
            'actions' => array(
                'add_block' => $this->urlGenerator->generate('opsite_builder_api_add_block_to_page', array(
                    'id' => $object->getId(),
                    'type' => static::BLOCK_TYPE_PLACEHOLDER
                )),
                'move_block' => $this->urlGenerator->generate('opsite_builder_api_move_block', array(
                    'id' => $object->getId(),
                    'blockId' => static::BLOCK_ID_PLACEHOLDER
                )),
            ),
            'blocks' => array()
        );

        // Normalize blocks (waiting for new serializer component)
        foreach ($object->getBlocks() as $block) {
            $page['blocks'][] = $this->blockNormalize->normalize($block, $format, $context);
        }

        return $page;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof AbstractPage;
    }
}
