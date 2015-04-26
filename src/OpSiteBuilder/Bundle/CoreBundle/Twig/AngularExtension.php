<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Twig;

/**
 * Class AngularExtension
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Twig
 * @author jobou
 */
class AngularExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter(
                'to_html_attributes',
                array($this, 'toHtmlAttributes'),
                array('is_safe' => array('html'))
            )
        );
    }

    /**
     * Transform an array to html attributes
     *
     * @param array $attributes
     *
     * @return string
     */
    public function toHtmlAttributes(array $attributes)
    {
        return join(' ', array_map(function ($key) use ($attributes) {
            return $key.'="'.$attributes[$key].'"';
        }, array_keys($attributes)));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'opsite_builder_angular_extension';
    }
}
