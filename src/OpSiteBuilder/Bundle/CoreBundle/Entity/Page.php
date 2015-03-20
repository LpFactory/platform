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
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * Add children
     *
     * @param \OpSiteBuilder\Bundle\CoreBundle\Entity\Page $children
     * @return Page
     */
    public function addChild(Page $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \OpSiteBuilder\Bundle\CoreBundle\Entity\Page $children
     */
    public function removeChild(Page $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \OpSiteBuilder\Bundle\CoreBundle\Entity\Page $parent
     * @return Page
     */
    public function setParent(Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \OpSiteBuilder\Bundle\CoreBundle\Entity\Page
     */
    public function getParent()
    {
        return $this->parent;
    }
}
