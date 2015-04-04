<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Model;

/**
 * Class AbstractBlock
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Model
 * @author jobou
 */
abstract class AbstractBlock
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $sort = 1;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var AbstractPage
     */
    protected $page;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     *
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
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
     * Increment the sort value
     *
     * @return $this
     */
    public function incSort()
    {
        $this->setSort($this->getSort() + 1);

        return $this;
    }

    /**
     * Define if this block type is editable
     *
     * @return bool
     */
    public function isEditable()
    {
        return false;
    }

    /**
     * Get page
     *
     * @return AbstractPage
     */
    abstract public function getPage();

    /**
     * Set page
     *
     * @param AbstractPage $page
     *
     * @return $this
     */
    abstract public function setPage(AbstractPage $page);

    /**
     * Get the name of a block
     *
     * @return string
     */
    abstract public function getAlias();

    /**
     * Check if block is empty
     * If null, use the manager to fetch data and see if block is empty
     *
     * @return bool
     */
    abstract public function isEmpty();
}
