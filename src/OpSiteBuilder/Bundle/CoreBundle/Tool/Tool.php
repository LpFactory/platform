<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tool;

use OpSiteBuilder\Bundle\CoreBundle\Configuration\AbstractConfigurableItem;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Tool
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tool
 * @author jobou
 */
class Tool extends AbstractConfigurableItem implements ToolInterface
{
    /**
     * Configure resolver
     *
     * @param OptionsResolver $resolver
     */
    protected function configureResolver(OptionsResolver $resolver)
    {
        $resolver->setRequired(array(
            'directive',
            'directive_attributes',
            'enabled',
            'pages',
            'priority'
        ));

        $resolver->setAllowedTypes('directive', 'string');
        $resolver->setAllowedTypes('directive_attributes', 'array');
        $resolver->setAllowedTypes('enabled', 'bool');
        $resolver->setAllowedTypes('pages', 'array');
        $resolver->setAllowedTypes('priority', 'int');
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return (bool) $this->get('enabled');
    }

    /**
     * {@inheritdoc}
     */
    public function supportsPage(AbstractPage $page)
    {
        $pages = $this->get('pages');

        // None configured then always supports
        if (count($pages) === 0) {
            return true;
        }

        foreach ($pages as $pageClass) {
            if ($page instanceof $pageClass) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return (int) $this->get('priority');
    }

    /**
     * {@inheritdoc}
     */
    public function getDirective()
    {
        return $this->get('directive');
    }

    /**
     * {@inheritdoc}
     */
    public function getDirectiveAttributes()
    {
        return $this->get('directive_attributes');
    }
}
