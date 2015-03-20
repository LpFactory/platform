<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Routing;

use Symfony\Cmf\Component\Routing\Candidates\Candidates;

/**
 * Class PageCandidates
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Routing
 * @author jobou
 */
class PageCandidates extends Candidates
{
    /**
     * {@inheritdoc}
     */
    protected function getCandidatesFor($url, $prefix = '')
    {
        $candidates = array();
        if ('/' !== $url) {
            // handle format extension, like .html or .json
            if (preg_match('/(.+)\.[a-z]+$/i', $url, $matches)) {
                $url = $matches[1];
            }

            $part = $url;
            $count = 0;
            while (false !== ($pos = strrpos($part, '/'))) {
                if (++$count > $this->limit) {
                    return $candidates;
                }

                if (isset($part[$pos+1])) {
                    $candidates[] = substr($part, $pos+1);
                }
                $part = substr($part, 0, $pos);
            }
        }

        return array_reverse($candidates);
    }
}
