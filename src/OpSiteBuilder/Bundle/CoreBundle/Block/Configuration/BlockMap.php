<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Configuration;

use OpSiteBuilder\Bundle\CoreBundle\Configuration\AbstractConfigurableItem;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BlockMap
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Configuration
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

        $resolver->setAllowedTypes('class', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->get('class');
    }
}
