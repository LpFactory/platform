<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Doctrine\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

/**
 * Class MapDiscriminatorListener
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Doctrine\EventListener
 * @author jobou
 */
class MapDiscriminatorListener
{
    /**
     * @var DoctrineDiscriminatorProviderInterface
     */
    protected $discriminatorProvider;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor
     *
     * @param string                                 $class
     * @param DoctrineDiscriminatorProviderInterface $discriminatorProvider
     */
    public function __construct($class, DoctrineDiscriminatorProviderInterface $discriminatorProvider)
    {
        $this->class = $class;
        $this->discriminatorProvider = $discriminatorProvider;
    }

    /**
     * Load class metadata
     * Extends discriminator map
     *
     * @param LoadClassMetadataEventArgs $event
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $event)
    {
        $metadata = $event->getClassMetadata();

        if ($metadata->getName() === $this->class) {
            $metadata->setDiscriminatorMap($this->discriminatorProvider->getDiscriminatorMap());
        }
    }
}
