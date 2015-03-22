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
     * @var array
     */
    protected $map;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor
     *
     * @param string $class
     * @param array  $map
     */
    public function __construct($class, array $map = array())
    {
        $this->class = $class;
        $this->map = $map;
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
            $metadata->setDiscriminatorMap($this->map);
        }
    }
}