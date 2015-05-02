<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Provider;

use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class DefaultDataProvider
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Provider
 * @author jobou
 */
class DefaultDataProvider implements BlockDataProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getData(AbstractBlock $block)
    {
        return array();
    }
}
