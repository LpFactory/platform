<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Twig;

use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class SerializerExtension
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Twig
 * @author jobou
 */
class SerializerExtension extends \Twig_Extension
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * Constructor
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('opsite_serialize', array($this, 'serialize'), array('is_safe' => array('html')))
        );
    }

    /**
     * Serialize an object using SF serializer
     *
     * @param mixed  $object
     * @param string $format
     *
     * @return string
     *
     */
    public function serialize($object, $format = 'json')
    {
        return $this->serializer->serialize($object, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'opsite_builder_serializer_extension';
    }
}
