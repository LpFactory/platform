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
     *
     * @return Response
     */
    public function viewAction(AbstractBlock $block)
    {
        $data = $this->get('opsite_builder.block.manager')->getData($block);

        return $this->render('OpSiteBuilderWebBundle:Block/view:default.html.twig', array(
            'block' => $block,
            'data' => $data
        ));
    }
}
