<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Configuration;

/**
 * Class BlockConfigurationChain
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
class BlockConfigurationChain implements BlockConfigurationChainInterface
{
    /**
     * @var string
     */
    protected $defaultAlias;

    /**
     * @var array
     */
    protected $configurations = array();

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
    public function addConfiguration(BlockConfigurationInterface $configuration, $alias)
    {
        $this->configurations[$alias] = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration($alias)
    {
        if (isset($this->configurations[$alias])) {
            return $this->configurations[$alias];
        }

        if (!isset($this->configurations[$this->defaultAlias])) {
            throw new \LogicException('No default configuration configured');
        }

        return $this->configurations[$this->defaultAlias];
    }
}
