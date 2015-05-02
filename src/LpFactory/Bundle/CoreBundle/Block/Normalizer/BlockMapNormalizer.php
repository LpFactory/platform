<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Normalizer;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMapInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class BlockMapNormalizer
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Normalizer
 * @author jobou
 */
class BlockMapNormalizer implements NormalizerInterface
{
    /**
     * Normalize a BlockMap
     *
     * @param BlockMapInterface $object
     * @param string            $format
     * @param array             $context
     *
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof BlockMapInterface;
    }
}
