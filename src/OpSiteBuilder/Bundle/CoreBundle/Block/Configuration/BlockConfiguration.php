<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Configuration;

use OpSiteBuilder\Bundle\CoreBundle\Block\Exception\UnknownBlockOptionException;
use OpSiteBuilder\Bundle\CoreBundle\Configuration\AbstractConfigurableItem;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DefaultConfiguration
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
class BlockConfiguration extends AbstractConfigurableItem implements BlockConfigurationInterface
{
    /**
     * Configure resolver
     *
     * @param OptionsResolver $resolver
     */
    protected function configureResolver(OptionsResolver $resolver)
    {
        $resolver->setRequired(array(
            'view_template',
            'view_controller',
            'view_route',
            'edit_controller',
            'edit_route',
            'edit_template',
            'edit_form_type',
            'options'
        ));

        $resolver->setAllowedTypes('view_template', 'string');
        $resolver->setAllowedTypes('view_controller', 'string');
        $resolver->setAllowedTypes('view_route', 'string');
        $resolver->setAllowedTypes('edit_controller', 'string');
        $resolver->setAllowedTypes('edit_route', 'string');
        $resolver->setAllowedTypes('edit_template', 'string');
        $resolver->setAllowedTypes('edit_form_type', array('null', 'string'));
        $resolver->setAllowedTypes('options', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getViewController()
    {
        return $this->get('view_controller');
    }

    /**
     * {@inheritdoc}
     */
    public function getViewRoute()
    {
        return $this->get('view_route');
    }

    /**
     * {@inheritdoc}
     */
    public function getViewTemplate()
    {
        return $this->get('view_template');
    }

    /**
     * {@inheritdoc}
     */
    public function getEditController()
    {
        return $this->get('edit_controller');
    }

    /**
     * {@inheritdoc}
     */
    public function getEditRoute()
    {
        return $this->get('edit_route');
    }

    /**
     * {@inheritdoc}
     */
    public function getEditTemplate()
    {
        return $this->get('edit_template');
    }

    /**
     * {@inheritdoc}
     */
    public function getEditFormType()
    {
        return $this->get('edit_form_type');
    }

    /**
     * Check if option exists
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasOption($key)
    {
        $options = $this->get('options');
        return isset($options[$key]);
    }

    /**
     * Get an option
     *
     * @param string $key
     *
     * @throws UnknownBlockOptionException
     */
    public function getOption($key)
    {
        if (!$this->hasOption($key)) {
            throw new UnknownBlockOptionException('Option '.$key.' not configured');
        }

        $options = $this->get('options');
        return $options[$key];
    }
}
