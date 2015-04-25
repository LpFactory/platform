<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Configuration;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractConfigurableItem
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Configuration
 * @author jobou
 */
abstract class AbstractConfigurableItem
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * Constructor
     *
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $resolver = new OptionsResolver();
        $this->configureResolver($resolver);

        $this->configuration = $resolver->resolve($configuration);
    }

    /**
     * Configure resolver
     *
     * @param OptionsResolver $resolver
     */
    abstract protected function configureResolver(OptionsResolver $resolver);

    /**
     * Get value from key
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->configuration[$key];
    }
}
