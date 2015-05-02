<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Block\TextBlockBundle\Entity;

use LpFactory\Bundle\CoreBundle\Entity\Block;

/**
 * Class TextBlock
 *
 * @package LpFactory\Block\TextBlockBundle\Entity
 * @author jobou
 */
class TextBlock extends Block
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return empty($this->content);
    }

    /**
     * {@inheritdoc}
     */
    public function isEditable()
    {
        return true;
    }
}
