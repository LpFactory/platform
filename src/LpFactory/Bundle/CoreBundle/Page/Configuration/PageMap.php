<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Page\Configuration;

use LpFactory\Bundle\CoreBundle\Doctrine\EventListener\DoctrineDiscriminatorProviderInterface;

/**
 * Class PageMap
 *
 * @package LpFactory\Bundle\CoreBundle\Page\Configuration
 * @author jobou
 */
class PageMap implements DoctrineDiscriminatorProviderInterface
{
    /**
     * @var array
     */
    protected $map;

    /**
     * Constructor
     *
     * @param array $map
     */
    public function __construct(array $map = array())
    {
        $this->map = $map;
    }

    /**
     * Get the discriminator map for Doctrine class metadata
     *
     * @return array
     */
    public function getDiscriminatorMap()
    {
        return $this->map;
    }
}
