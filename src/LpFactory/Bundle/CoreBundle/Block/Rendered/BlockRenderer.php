<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Block\Rendered;

use LpFactory\Bundle\CoreBundle\Block\BlockManagerInterface;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class BlockRenderer
 *
 * @package LpFactory\Bundle\CoreBundle\Block\Rendered
 * @author jobou
 */
class BlockRenderer implements BlockRendererInterface
{
    /**
     * @var BlockManagerInterface
     */
    protected $blockManager;

    /**
     * @var BlockConfigurationChainInterface
     */
    protected $configurationChain;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param BlockManagerInterface            $blockManager
     * @param BlockConfigurationChainInterface $configurationChain
     * @param EngineInterface                  $templating
     */
    public function __construct(
        BlockManagerInterface $blockManager,
        BlockConfigurationChainInterface $configurationChain,
        EngineInterface $templating
    ) {
        $this->blockManager = $blockManager;
        $this->configurationChain = $configurationChain;
        $this->templating = $templating;
    }

    /**
     * {@inheritdoc}
     */
    public function renderView(AbstractBlock $block, $edit = false)
    {
        return $this->templating->render(
            $this->configurationChain->getConfiguration($block->getAlias())->getViewTemplate(),
            array(
                'block' => $block,
                'data' => $this->blockManager->getData($block),
                'edit' => $edit
            )
        );
    }
}
