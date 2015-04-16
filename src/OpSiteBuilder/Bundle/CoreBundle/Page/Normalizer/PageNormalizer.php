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
     * @var NormalizerInterface
     */
    protected $blockNormalize;

    /**
     * Constructor
     *
     * @param NormalizerInterface $blockNormalize
     */
    public function __construct(NormalizerInterface $blockNormalize)
    {
        $this->blockNormalize = $blockNormalize;
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
        $page = array(
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'slug' => $object->getSlug(),
            'created' => $object->getCreated(),
            'updated' => $object->getUpdated(),
            'blocks' => array()
        );

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
