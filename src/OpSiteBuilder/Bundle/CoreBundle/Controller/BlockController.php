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
use OpSiteBuilder\Bundle\CoreBundle\Security\SecurityAttributes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * View block (from url)
     *
     * @param Request $request
     * @param int     $id
     */
    public function viewAction(Request $request, $id)
    {
        /** @var AbstractBlock $block */
        $block = $this->get('opsite_builder.repository.block')->findWithPage((int) $id);
        if (!$block) {
            throw $this->createNotFoundException('Unknown block #' . $id);
        }

        return $this->defaultAction($block);
    }

    /**
     * Display a block view when we have the object
     *
     * @param AbstractBlock $block
     * @param bool          $edit
     *
     * @return Response
     */
    public function defaultAction(AbstractBlock $block, $edit = false)
    {
        $response = new Response();
        return $response->setContent(
            $this->get('opsite_builder.block.renderer')->renderView($block, $edit)
        );
    }

    /**
     * Edit a block
     *
     * @param int $id
     *
     * @return Response
     */
    public function editAction($id)
    {
        /** @var AbstractBlock $block */
        $block = $this->get('opsite_builder.repository.block')->findWithPage((int) $id);
        if (!$block) {
            throw $this->createNotFoundException('Unknown block #' . $id);
        }

        $page = $block->getPage();
        if (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Edit block denied in page ' . $page->getId());
        }

        return $this->render('OpSiteBuilderWebBundle:Block/view:default_edit.html.twig', array(
            'block' => $block
        ));
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

        $page = $block->getPage();
        if (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Remove block denied for page ' . $page->getId());
        }

        $this->get('opsite_builder.block.manager')->remove($block);

        return new Response('', 204);
    }
}
