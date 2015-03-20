<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Controller;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PageController
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Controller
 * @author jobou
 */
class PageController extends Controller
{
    /**
     * Page detail
     *
     * @param AbstractPage $page
     *
     * @return Response
     */
    public function indexAction(AbstractPage $page, $path)
    {
        var_dump($page->getSlug());
        var_dump(count($path));
        return new Response('<html><body>toto</body></html>');
    }
}