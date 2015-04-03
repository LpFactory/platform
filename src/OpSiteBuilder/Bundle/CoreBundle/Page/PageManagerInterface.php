<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Page;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface PageManagerInterface
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Page
 * @author jobou
 */
interface PageManagerInterface
{
    /**
     * Save a page
     *
     * @param AbstractPage $page
     * @param bool         $flush
     * @param bool         $cascade
     *
     * @return null
     */
    public function save(AbstractPage $page, $flush = true, $cascade = false);
}
