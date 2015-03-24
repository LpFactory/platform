<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Block\BlogBlockBundle\Entity;

use OpSiteBuilder\Bundle\CoreBundle\Entity\Block;

/**
 * Class BlogBlock
 *
 * @package OpSiteBuilder\Block\BlogBlockBundle\Entity
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
