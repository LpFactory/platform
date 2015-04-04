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
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockFactoryInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
 * @author jobou
 */
interface BlockFactoryInterface
{
    /**
     * Get a new instance of a specific bloc
     *
     * @param string $type
     *
     * @return AbstractBlock
     *
     * @throws UnknownBlockTypeException
     */
    public function create($type);
}
