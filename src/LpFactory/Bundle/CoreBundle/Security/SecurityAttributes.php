<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Security;

/**
 * Class SecurityAttributes
 *
 * @package LpFactory\Bundle\CoreBundle\Security
 * @author jobou
 */
class SecurityAttributes
{
    /**
     * Attribute allowing to edit page
     *
     * @return string
     */
    const PAGE_EDIT = 'lp_factory_PAGE_EDIT';

    /**
     * Attribute allowing to view a page
     *
     * @return string
     */
    const PAGE_VIEW = 'lp_factory_PAGE_VIEW';

    /**
     * Attribute allowing to delete a page
     *
     * @return string
     */
    const PAGE_DELETE = 'lp_factory_PAGE_DELETE';

    /**
     * Attribute allowing to edit block
     *
     * @return string
     */
    const BLOCK_EDIT = 'lp_factory_BLOCK_EDIT';

    /**
     * Attribute allowing to view a block
     *
     * @return string
     */
    const BLOCK_VIEW = 'lp_factory_BLOCK_VIEW';

    /**
     * Attribute allowing to delete a block
     *
     * @return string
     */
    const BLOCK_DELETE = 'lp_factory_BLOCK_DELETE';
}
