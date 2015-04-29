<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Configuration;

/**
 * Interface BlockMapChainInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Configuration
 * @author jobou
 */
interface BlockMapChainInterface
{
    /**
     * Get map for alias
     *
     * @param string $alias
     *
     * @return BlockMapInterface
     *
     * @throws \LogicException
     */
    public function getMap($alias);

    /**
     * Check if block map exists
     *
     * @param string $alias
     *
     * @return bool
     */
    public function has($alias);

    /**
     * Return all available types
     *
     * @return array
     */
    public function keys();
}