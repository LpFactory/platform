<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Block\TextBlockBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class LpFactoryTextBlockExtension
 *
 * @package LpFactory\Bundle\CoreBundle\DependencyInjection
 * @author jobou
 */
class LpFactoryTextBlockExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('entities.yml');
        $loader->load('form_type.yml');
    }

    /**
     * Prepend some configuration to container
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        // Bundle prepend default configuration
        $this->prependBlockConfiguration($container);

        // Bundle prepend map
        $this->prependBlockMap($container);
    }

    /**
     * Preprend block map
     *
     * @param ContainerBuilder $container
     */
    public function prependBlockMap(ContainerBuilder $container)
    {
        $container->prependExtensionConfig(
            'lp_factory_core',
            array(
                'block_map' => array(
                    'text' => array(
                        'class' => 'LpFactory\Block\TextBlockBundle\Entity\TextBlock',
                        'label' => 'tools.text.label',
                        'text'  => 'tools.text.text'
                    )
                )
            )
        );
    }

    /**
     * Prepend block configuration
     *
     * @param ContainerBuilder $container
     */
    protected function prependBlockConfiguration(ContainerBuilder $container)
    {
        $container->prependExtensionConfig(
            'lp_factory_core',
            array(
                'block_configuration' => array(
                    'text' => array(
                        'view_template'   => 'LpFactoryTextBlockBundle::view.html.twig',
                        'edit_route'      => 'lp_factory_api_edit_form_block',
                        'edit_template'   => 'LpFactoryTextBlockBundle::edit.html.twig',
                        'edit_form_type'  => 'block_text'
                    )
                )
            )
        );
    }
}
