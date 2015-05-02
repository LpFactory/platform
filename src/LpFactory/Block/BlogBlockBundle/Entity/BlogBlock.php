<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Block\BlogBlockBundle\Entity;

use LpFactory\Bundle\CoreBundle\Entity\Block;

/**
 * Class BlogBlock
 *
 * @package LpFactory\Block\BlogBlockBundle\Entity
 * @author jobou
 */
class BlogBlock extends Block
{
    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return null;
    }
}
