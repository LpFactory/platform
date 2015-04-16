<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Normalizer;

use OpSiteBuilder\Bundle\CoreBundle\Block\Rendered\BlockRendererInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class BlockNormalizer
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Normalizer
 * @author jobou
 */
class BlockNormalizer implements NormalizerInterface
{
    /**
     * Normalize a block
     *
     * @param AbstractBlock $object
     * @param string        $format
     * @param array         $context
     *
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return array(
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'sort' => $object->getSort(),
            'type' => $object->getAlias(),
            'created' => $object->getCreated(),
            'updated' => $object->getUpdated()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof AbstractBlock;
    }
}
