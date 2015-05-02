<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Page\Normalizer;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Interface ToolNormalizerInterface
 *
 * @package LpFactory\Bundle\CoreBundle\Page\Normalizer
 * @author jobou
 */
interface ToolPostNormalizerInterface
{
    /**
     * Post normalize the page
     *
     * @param array        $normalizedData
     * @param AbstractPage $page
     */
    public function postNormalize(array &$normalizedData, AbstractPage $page);
}
