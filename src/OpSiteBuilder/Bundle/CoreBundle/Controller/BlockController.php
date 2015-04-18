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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     *
     * @return Response
     */
    public function viewAction(Request $request, $id)
    {
        $edit = (bool) $request->query->get('edit', false);

        return $this->defaultAction($this->loadBlock($id), $edit);
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
        return $this->defaultEditAction($this->loadBlock($id));
    }

    /**
     * Display the default template when no edit form has been configurated
     * when we have the object
     *
     * @param AbstractBlock $block
     *
     * @return Response
     */
    public function defaultEditAction(AbstractBlock $block)
    {
        $this->isGrantedPageEdit($block);

        return $this->render('OpSiteBuilderWebBundle:Block/View:default_edit.html.twig', array(
            'block' => $block
        ));
    }

    /**
     * Edit a block with a form
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function editFormAction(Request $request, $id)
    {
        $block = $this->loadBlock($id);
        $this->isGrantedPageEdit($block);

        $configuration = $this->get('opsite_builder.block.configuration.chain')->getConfiguration($block->getAlias());
        if (null === $editFormType = $configuration->getEditFormType()) {
            return $this->defaultEditAction($block);
        }

        $form = $this->createForm($editFormType, $block);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->get('opsite_builder.block.manager')->save($block);

            return $this->defaultAction($block, true);
        }

        return $this->render($configuration->getEditTemplate(), array(
            'form' => $form->createView(),
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
        $block = $this->loadBlock($id);
        $this->isGrantedPageEdit($block);

        $this->get('opsite_builder.block.manager')->remove($block);

        return new Response('', 204);
    }

    /**
     * Load a block with its page
     *
     * @param int $id
     *
     * @return AbstractBlock
     *
     * @throws NotFoundHttpException
     */
    protected function loadBlock($id)
    {
        /** @var AbstractBlock $block */
        $block = $this->get('opsite_builder.repository.block')->findWithPage((int) $id);
        if (!$block) {
            throw $this->createNotFoundException('Unknown block #' . $id);
        }

        return $block;
    }

    /**
     * Check if user can edit page (and so the block too)
     *
     * @param AbstractBlock $block
     *
     * @throws AccessDeniedException
     */
    protected function isGrantedPageEdit(AbstractBlock $block)
    {
        $page = $block->getPage();
        if (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Remove block denied for page ' . $page->getId());
        }
    }
}
