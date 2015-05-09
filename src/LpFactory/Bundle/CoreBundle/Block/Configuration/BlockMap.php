<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Configuration;

use LpFactory\Bundle\CoreBundle\Configuration\AbstractConfigurableItem;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BlockMap
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
class BlockMap extends AbstractConfigurableItem implements BlockMapInterface
{
    /**
     * Configure resolver
     *
     * @param OptionsResolver $resolver
     */
    protected function configureResolver(OptionsResolver $resolver)
    {
        $resolver->setRequired(array(
            'class'
        ));

        $resolver->setDefaults(array(
            'label' => null,
            'picto' => null,
            'text' => null,
        ));

        $resolver->setAllowedTypes('class', 'string');
        $resolver->setAllowedTypes('label', array('null', 'string'));
        $resolver->setAllowedTypes('picto', array('null', 'string'));
        $resolver->setAllowedTypes('text', array('null', 'string'));
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->get('class');
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->get('label');
    }

    /**
     * {@inheritdoc}
     */
    public function getPicto()
    {
        return $this->get('picto');
    }

    /**
     * {@inheritdoc}
     */
    public function getText()
    {
        return $this->get('text');
    }
}
