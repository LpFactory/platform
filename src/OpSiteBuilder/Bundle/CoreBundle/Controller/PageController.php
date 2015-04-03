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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     */
    public function editAction(AbstractPage $page, $path)
    {
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
     * @return \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @throws \OpSiteBuilder\Bundle\CoreBundle\Exception\OpSiteBuilderException
     */
    public function addBlockAction($id, $type)
    {
        /** @var AbstractPage $page */
        $page = $this->get('opsite_builder.repository.page')->find($id);
        if (!$page) {
            throw $this->createNotFoundException('Unknown page id ' . $id);
        }

        try {
            $block = $this->get('opsite_builder.block.factory')->create($type);
        } catch (UnknownBlockTypeException $e) {
            throw $this->createNotFoundException('Unknown block type ' . $type, $e);
        }

        // Insert a block at its sort position
        $position = $this->get('opsite_builder.block.strategy.position')->getPosition($block, $page);
        $block->setSort($position);
        $page->insertBlock($block);

        // Persist new block and page
        $this->get('opsite_builder.page.manager')->save($page, true, true);

        return new JsonResponse($this->get('serializer')->normalize($block));
    }
}
