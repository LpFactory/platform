<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Controller;

use OpSiteBuilder\Bundle\CoreBundle\Block\Exception\UnknownBlockTypeException;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;
use OpSiteBuilder\Bundle\CoreBundle\Security\SecurityAttributes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     * @param array        $path
     *
     * @return Response
     */
    public function indexAction(AbstractPage $page, $path)
    {
        return $this->render('OpSiteBuilderWebBundle:Page:index.html.twig', array(
            'page' => $page,
            'breadcrumbs' => $path
        ));
    }

    /**
     * Page edit
     *
     * @param AbstractPage $page
     * @param array        $path
     *
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function editAction(AbstractPage $page, $path)
    {
        if (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Edit denied for page ' . $page->getId());
        }

        return $this->render('OpSiteBuilderWebBundle:Page:edit.html.twig', array(
            'page' => $page,
            'breadcrumbs' => $path
        ));
    }

    /**
     * Add a block to a page
     *
     * @param int    $id
     * @param string $type
     *
     * @return JsonResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \OpSiteBuilder\Bundle\CoreBundle\Exception\OpSiteBuilderException
     */
    public function addBlockAction($id, $type)
    {
        /** @var AbstractPage $page */
        $page = $this->get('opsite_builder.repository.page')->find($id);
        if (!$page) {
            throw $this->createNotFoundException('Unknown page id ' . $id);
        } elseif (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Add block denied for page ' . $page->getId());
        }

        try {
            $block = $this->get('opsite_builder.block.factory')->create($type);
        } catch (UnknownBlockTypeException $e) {
            throw $this->createNotFoundException('Unknown block type ' . $type, $e);
        }

        // Add and persist new block and page
        $pageManager = $this->get('opsite_builder.page.manager');
        $pageManager->addBlock($page, $block);
        $pageManager->save($page, true, true);

        return new JsonResponse($this->get('serializer')->normalize($block));
    }

    /**
     * Move a block to a new position in the page
     *
     * @param Request $request
     * @param int     $id
     * @param int     $blockId
     *
     * @return Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function moveBlockAction(Request $request, $id, $blockId)
    {
        $position = (int) $request->query->get('position', 1);

        /** @var AbstractBlock $block */
        $block = $this->get('opsite_builder.repository.block')->findBlockInPageById($blockId, $id);
        if (!$block) {
            throw $this->createNotFoundException('Unknown block id ' . $blockId . ' in page ' . $id);
        }

        $page = $block->getPage();
        if (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Move block denied for page ' . $id);
        }

        // Add and persist new block and page
        $pageManager = $this->get('opsite_builder.page.manager');
        $pageManager->moveBlock($page, $block, $position);
        $pageManager->save($page, true, true);

        return new Response('', 204);
    }
}
