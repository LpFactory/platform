<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tool;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface ToolChainInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tool
 * @author jobou
 */
interface ToolChainInterface
{
    /**
     * Add a tool to the chain
     *
     * @param ToolInterface $tool
     * @param string        $alias
     *
     * @return ToolChainInterface
     */
    public function addTool(ToolInterface $tool, $alias);

    /**
     * Get all tools
     *
     * @return array
     */
    public function all();

    /**
     * Get all in page
     *
     * @param AbstractPage $page
     *
     * @return array
     */
    public function allInPage(AbstractPage $page);
}
