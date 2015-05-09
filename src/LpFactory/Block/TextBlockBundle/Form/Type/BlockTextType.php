<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Block\TextBlockBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BlockTextType
 *
 * @package LpFactory\Block\TextBlockBundle\Form\Type
 * @author jobou
 */
class BlockTextType extends AbstractType
{
    /**
     * @var string
     */
    protected $blockClass;

    /**
     * Constructor
     *
     * @param $blockClass
     */
    public function __construct($blockClass)
    {
        $this->blockClass = $blockClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', 'textarea', array(
                'attr' => array(
                    'lpfactory-ck-editor' => null
                )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->blockClass,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'block_text';
    }
}
