<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class Page
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Entity
 * @author jobou
 */
class Page extends AbstractPage
{
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $children;

    /**
     * @var \OpSiteBuilder\Bundle\CoreBundle\Entity\Page
     */
    protected $parent;

    /**
     * @var ArrayCollection
     */
    protected $blocks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->blocks   = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addChild(AbstractPage $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeChild(AbstractPage $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(AbstractPage $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function addBlock(AbstractBlock $block)
    {
        $this->blocks[] = $block;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeBlock(AbstractBlock $block)
    {
        $this->blocks->removeElement($block);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlocks()
    {
        return $this->blocks;
    }
}
