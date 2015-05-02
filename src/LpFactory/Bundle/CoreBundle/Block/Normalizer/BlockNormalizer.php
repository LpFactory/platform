<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Normalizer;

use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class BlockNormalizer
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Normalizer
 * @author jobou
 */
class BlockNormalizer implements NormalizerInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;

    /**
     * @var BlockConfigurationChainInterface
     */
    protected $configuration;

    /**
     * Constructor
     *
     * @param UrlGeneratorInterface            $urlGenerator
     * @param BlockConfigurationChainInterface $configuration
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, BlockConfigurationChainInterface $configuration)
    {
        $this->urlGenerator = $urlGenerator;
        $this->configuration = $configuration;
    }

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
        $blockConfiguration = $this->configuration->getConfiguration($object->getAlias());

        return array(
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'sort' => $object->getSort(),
            'type' => $object->getAlias(),
            'created' => $object->getCreated(),
            'updated' => $object->getUpdated(),
            'actions' => array(
                'view' => $this->urlGenerator->generate(
                    $blockConfiguration->getViewRoute(),
                    array(
                        'id' => $object->getId()
                    )
                ),
                'view_editable' => $this->urlGenerator->generate(
                    $blockConfiguration->getViewRoute(),
                    array(
                        'id' => $object->getId(),
                        'edit' => true
                    )
                ),
                'edit' => $this->urlGenerator->generate(
                    $blockConfiguration->getEditRoute(),
                    array(
                        'id' => $object->getId()
                    )
                ),
                'remove' => $this->urlGenerator->generate(
                    'lp_factory_api_remove_block',
                    array(
                        'id' => $object->getId()
                    )
                ),
            )
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
