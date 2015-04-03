<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use OpSiteBuilder\Bundle\CoreBundle\Exception\OpSiteBuilderException;

/**
 * Class AbstractPage
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Model
 * @author  jobou
 */
abstract class AbstractPage
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $lft;

    /**
     * @var int
     */
    protected $lvl;

    /**
     * @var int
     */
    protected $rgt;

    /**
     * @var int
     */
    protected $root;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var ArrayCollection
     */
    protected $blocks;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return AbstractPage
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return AbstractPage
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return AbstractPage
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return AbstractPage
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * is Root
     *
     * @return bool
     */
    public function isRoot()
    {
        return $this->getLvl() === 0;
    }

    /**
     * Insert a block
     *
     * @param $position
     *
     * @return AbstractPage
     *
     */
    public function shiftBlock($position)
    {
        $this->getBlocks()->map(function (AbstractBlock $block) use ($position) {
            if ($block->getSort() >= $position) {
                $block->incSort();
            }
        });

        return $this;
    }

    /**
     * Add children
     *
     * @param AbstractPage $child
     *
     * @return AbstractPage
     */
    abstract public function addChild(AbstractPage $child);

    /**
     * Remove children
     *
     * @param AbstractPage $child
     */
    abstract public function removeChild(AbstractPage $child);

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    abstract public function getChildren();

    /**
     * Set parent
     *
     * @param AbstractPage $parent
     *
     * @return AbstractPage
     */
    abstract public function setParent(AbstractPage $parent = null);

    /**
     * Get parent
     *
     * @return AbstractPage
     */
    abstract public function getParent();

    /**
     * Add block
     *
     * @param AbstractBlock $block
     *
     * @return AbstractPage
     */
    abstract public function addBlock(AbstractBlock $block);

    /**
     * Remove block
     *
     * @param AbstractBlock $block
     */
    abstract public function removeBlock(AbstractBlock $block);

    /**
     * Get blocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    abstract public function getBlocks();
}
