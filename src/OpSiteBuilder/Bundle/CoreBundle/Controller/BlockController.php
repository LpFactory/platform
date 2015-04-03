<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Controller;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlockController
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Controller
 * @author jobou
 */
class BlockController extends Controller
{
    /**
     * Display a block view
     *
     * @param AbstractBlock $block
     * @param AbstractPage  $page
     *
     * @return Response
     */
    public function viewAction(AbstractBlock $block, AbstractPage $page)
    {
        $response = new Response();

        return $response->setContent(
            $this->get('opsite_builder.block.manager')->renderView($block)
        );
    }

    /**
     * Remove a block
     *
     * @param int $id
     *
     * @return Response
     */
    public function removeAction($id)
    {
        /** @var AbstractBlock $block */
        $block = $this->get('opsite_builder.repository.block')->find($id);
        if (!$block) {
            throw $this->createNotFoundException('Unknown block #' . $id);
        }

        $this->get('opsite_builder.block.manager')->remove($block);

        return new Response('', 204);
    }
}
