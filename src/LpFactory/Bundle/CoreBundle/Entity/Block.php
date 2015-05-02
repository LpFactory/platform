<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Entity;

use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class Block
 *
 * @package LpFactory\Bundle\CoreBundle\Entity
 * @author jobou
 */
abstract class Block extends AbstractBlock
{
    /**
     * @var AbstractPage
     */
    protected $page;

    /**
     * {@inheritdoc}
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * {@inheritdoc}
     */
    public function setPage(AbstractPage $page)
    {
        $this->page = $page;

        return $this;
    }
}
