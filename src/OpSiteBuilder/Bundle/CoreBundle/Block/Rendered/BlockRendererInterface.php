<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Rendered;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Interface BlockRendererInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Rendered
 * @author jobou
 */
interface BlockRendererInterface
{
    /**
     * Render the template for the block
     *
     * @param AbstractBlock $block
     * @param bool          $edit
     *
     * @return string
     */
    public function renderView(AbstractBlock $block, $edit = false);
}
