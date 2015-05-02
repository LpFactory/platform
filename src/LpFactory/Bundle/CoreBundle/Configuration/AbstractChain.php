<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Configuration;

/**
 * Class AbstractChain
 *
 * @package LpFactory\Bundle\CoreBundle\Configuration
 * @author jobou
 */
abstract class AbstractChain
{
    /**
     * @var string
     */
    protected $defaultAlias;

    /**
     * @var array
     */
    protected $items = array();

    /**
     * Constructor
     *
     * @param string $defaultAlias
     */
    public function __construct($defaultAlias = 'default')
    {
        $this->defaultAlias = $defaultAlias;
    }

    /**
     * Add an item
     *
     * @param mixed $item
     * @param string $alias
     *
     * @return $this
     */
    protected function addItem($item, $alias)
    {
        $this->items[$alias] = $item;

        return $this;
    }

    /**
     * Get item in a chain
     *
     * @param string $alias
     *
     * @return mixed
     */
    protected function getItem($alias)
    {
        if (isset($this->items[$alias])) {
            return $this->items[$alias];
        }

        if (!isset($this->items[$this->defaultAlias])) {
            throw new \LogicException('No default alias configured in '.get_class($this));
        }

        return $this->items[$this->defaultAlias];
    }
}
