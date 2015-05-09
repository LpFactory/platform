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
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class BlockMapNormalizer
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Normalizer
 * @author jobou
 */
class BlockMapNormalizer implements NormalizerInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Constructor
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

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
        return array(
            'label' => $this->translator->trans($object->getLabel()),
            'picto' => $object->getPicto(),
            'text'  => $this->translator->trans($object->getText()),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof BlockMapInterface;
    }
}
