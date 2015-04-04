<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block\Rendered;

use OpSiteBuilder\Bundle\CoreBundle\Block\BlockManagerInterface;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class BlockRenderer
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block\Rendered
 * @author jobou
 */
class BlockRenderer implements BlockRendererInterface
{
    /**
     * @var BlockManagerInterface
     */
    protected $blockManager;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param BlockManagerInterface $blockManager
     * @param EngineInterface       $templating
     */
    public function __construct(BlockManagerInterface $blockManager, EngineInterface $templating)
    {
        $this->blockManager = $blockManager;
        $this->templating = $templating;
    }

    /**
     * {@inheritdoc}
     */
    public function renderView(AbstractBlock $block, $edit = false)
    {
        return $this->templating->render('OpSiteBuilderWebBundle:Block/view:default_view.html.twig', array(
            'block' => $block,
            'data' => $this->blockManager->getData($block),
            'edit' => $edit
        ));
    }
}
