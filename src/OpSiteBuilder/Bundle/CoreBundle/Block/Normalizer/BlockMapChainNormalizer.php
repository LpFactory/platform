<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Normalizer;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class BlockMapChainNormalizer
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Normalizer
 * @author jobou
 */
class BlockMapChainNormalizer implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    protected $blockMapNormalizer;

    /**
     * Constructor
     *
     * @param NormalizerInterface $blockMapNormalizer
     */
    public function __construct(NormalizerInterface $blockMapNormalizer)
    {
        $this->blockMapNormalizer = $blockMapNormalizer;
    }

    /**
     * Normalize a BlockMapChain
     *
     * @param BlockMapChainInterface $object
     * @param string                 $format
     * @param array                  $context
     *
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $normalized = array();
        foreach ($object->all() as $alias => $blockMap) {
            $normalized[$alias] = $this->blockMapNormalizer->normalize($blockMap);
        }

        return $normalized;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof BlockMapChainInterface;
    }
}
