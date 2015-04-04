<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Security;

/**
 * Class SecurityAttributes
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Security
 * @author jobou
 */
class SecurityAttributes
{
    /**
     * Attribute allowing to edit page
     *
     * @return string
     */
    const PAGE_EDIT = 'OPSITE_BUILDER_PAGE_EDIT';

    /**
     * Attribute allowing to view a page
     *
     * @return string
     */
    const PAGE_VIEW = 'OPSITE_BUILDER_PAGE_VIEW';

    /**
     * Attribute allowing to delete a page
     *
     * @return string
     */
    const PAGE_DELETE = 'OPSITE_BUILDER_PAGE_DELETE';

    /**
     * Attribute allowing to edit block
     *
     * @return string
     */
    const BLOCK_EDIT = 'OPSITE_BUILDER_BLOCK_EDIT';

    /**
     * Attribute allowing to view a block
     *
     * @return string
     */
    const BLOCK_VIEW = 'OPSITE_BUILDER_BLOCK_VIEW';

    /**
     * Attribute allowing to delete a block
     *
     * @return string
     */
    const BLOCK_DELETE = 'OPSITE_BUILDER_BLOCK_DELETE';
}
