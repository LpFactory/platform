<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Doctrine\EventListener;

/**
 * Interface DoctrineDiscriminatorProviderInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Doctrine\EventListener
 * @author jobou
 */
interface DoctrineDiscriminatorProviderInterface
{
    /**
     * Get the discriminator map for Doctrine class metadata
     *
     * @return array
     */
    public function getDiscriminatorMap();
}
