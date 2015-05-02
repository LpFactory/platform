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
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use LpFactory\Bundle\CoreBundle\Page\Normalizer\ToolPostNormalizerInterface;

/**
 * Class PageNormalizer
 *
 * @package LpFactory\Bundle\CoreBundle\Page\Normalizer
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
     * @var array
     */
    protected $toolNormalizers = array();

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
                'move_block' => $this->urlGenerator->generate('lp_factory_api_move_block', array(
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

        // Post normalize using tool normalizers
        $this->postNormalize($page, $object);

        return $page;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof AbstractPage;
    }

    /**
     * Add Tool normalizer
     *
     * @param ToolPostNormalizerInterface $toolNormalizer
     *
     * @return $this
     */
    public function addToolNormalizer(ToolPostNormalizerInterface $toolNormalizer)
    {
        $this->toolNormalizers[] = $toolNormalizer;

        return $this;
    }

    /**
     * Post normalize the page by appending data from tools
     *
     * @param array        $normalizedData
     * @param AbstractPage $page
     *
     * @return array
     */
    protected function postNormalize(array &$normalizedData, AbstractPage $page)
    {
        /** @var ToolPostNormalizerInterface $normalizer */
        foreach ($this->toolNormalizers as $normalizer) {
            $normalizer->postNormalize($normalizedData, $page);
        }
    }
}
