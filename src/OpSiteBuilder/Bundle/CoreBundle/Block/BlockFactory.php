<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block;

use OpSiteBuilder\Bundle\CoreBundle\Block\Exception\UnknownBlockTypeException;

/**
 * Class BlockFactory
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
 * @author jobou
 */
class BlockFactory implements BlockFactoryInterface
{
    /**
     * @var array
     */
    protected $blockClassMap;

    /**
     * Constructor
     *
     * @param array $blockClassMap
     */
    public function __construct(array $blockClassMap = array())
    {
        $this->blockClassMap = $blockClassMap;
    }

    /**
     * {@inheritdoc}
     */
    public function create($type)
    {
        if (!isset($this->blockClassMap[$type])) {
            throw new UnknownBlockTypeException('Block type '.$type.' does not exists.');
        }

        return new $this->blockClassMap[$type]();
    }
}
