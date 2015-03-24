<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block;

/**
 * Class BlockDataProviderChain
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
 * @author jobou
 */
class BlockDataProviderChain implements BlockDataProviderChainInterface
{
    /**
     * @var string
     */
    protected $defaultAlias;

    /**
     * @var array
     */
    protected $providers = array();

    /**
     * Constructor
     *
     * @param string $defaultAlias
     */
    public function __construct($defaultAlias = 'default')
    {
        $this->defaultAlias = $defaultAlias;
    }

    /**
     * {@inheritdoc}
     */
    public function addProvider(BlockDataProviderInterface $provider, $alias)
    {
        $this->providers[$alias] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider($alias)
    {
        if (isset($this->providers[$alias])) {
            return $this->providers[$alias];
        }

        if (!isset($this->providers[$this->defaultAlias])) {
            throw new \LogicException('No default provider configured');
        }

        return $this->providers[$this->defaultAlias];
    }
}
