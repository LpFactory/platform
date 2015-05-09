<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Controller;

use LpFactory\Bundle\CoreBundle\Block\Exception\UnknownBlockTypeException;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;
use LpFactory\Bundle\CoreBundle\Security\SecurityAttributes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class PageController
 *
 * @package LpFactory\Bundle\CoreBundle\Controller
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
        return $this->render('LpFactoryCoreBundle:Page:index.html.twig', array(
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

        return $this->render('LpFactoryCoreBundle:Page:edit.html.twig', array(
            'page' => $page,
            'breadcrumbs' => $path,
            'tools' => $this->get('lp_factory.tools.chain')->allInPage($page),
            'block_map_chain' => $this->get('lp_factory.block.map.chain')
        ));
    }

    /**
     * Add a block to a page
     *
     * @param Request $request
     * @param int     $id
     * @param string  $type
     *
     * @return JsonResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \LpFactory\Bundle\CoreBundle\Exception\LpFactoryException
     */
    public function addBlockAction(Request $request, $id, $type)
    {
        $position = $request->query->get('position', false);

        /** @var AbstractPage $page */
        $page = $this->get('lp_factory.repository.page')->find($id);
        if (!$page) {
            throw $this->createNotFoundException('Unknown page id ' . $id);
        } elseif (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Add block denied for page ' . $page->getId());
        }

        try {
            $block = $this->get('lp_factory.block.factory')->create($type);
        } catch (UnknownBlockTypeException $e) {
            throw $this->createNotFoundException('Unknown block type ' . $type, $e);
        }

        // Add and persist new block and page
        $pageManager = $this->get('lp_factory.page.manager');
        $page->resetBlockSort();
        $pageManager->addBlock($page, $block, $position);
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
        $block = $this->get('lp_factory.repository.block')->findBlockInPageById($blockId, $id);
        if (!$block) {
            throw $this->createNotFoundException('Unknown block id ' . $blockId . ' in page ' . $id);
        }

        $page = $block->getPage();
        if (!$this->isGranted(SecurityAttributes::PAGE_EDIT, $page)) {
            throw $this->createAccessDeniedException('Move block denied for page ' . $id);
        }

        // Add and persist new block and page
        $pageManager = $this->get('lp_factory.page.manager');
        $pageManager->moveBlock($page, $block, $position);
        $pageManager->save($page, true, true);

        return new Response('', 204);
    }
}
