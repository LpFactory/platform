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

/**
 * Class AbstractPage
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Model
 * @author  jobou
 */
class AbstractPage
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
     * @var AbstractPage
     */
    protected $parent;

    /**
     * @var ArrayCollection
     */
    protected $children;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
        return $this->title;
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
     * @param AbstractPage $parent
     *
     * @return $this
     */
    public function setParent(AbstractPage $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return AbstractPage
     */
    public function getParent()
    {
        return $this->parent;
    }
}