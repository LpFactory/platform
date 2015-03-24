<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Entity;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class Block
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Entity
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
