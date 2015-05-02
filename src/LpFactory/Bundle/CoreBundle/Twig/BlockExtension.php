<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Twig;

use LpFactory\Bundle\CoreBundle\Block\BlockManagerInterface;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMap;
use LpFactory\Bundle\CoreBundle\Block\Configuration\BlockMapChainInterface;
use LpFactory\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class BlockExtension
 *
 * @package LpFactory\Bundle\CoreBundle\Twig
 * @author jobou
 */
class BlockExtension extends \Twig_Extension
{
    /**
     * @var BlockConfigurationChainInterface
     */
    protected $configurationChain;

    /**
     * @var BlockManagerInterface
     */
    protected $blockManager;

    /**
     * @var BlockMapChainInterface
     */
    protected $blockMap;

    /**
     * Constructor
     *
     * @param BlockConfigurationChainInterface $configurationChain
     * @param BlockManagerInterface            $blockManager
     * @param BlockMapChainInterface           $blockMap
     */
    public function __construct(
        BlockConfigurationChainInterface $configurationChain,
        BlockManagerInterface $blockManager,
        BlockMapChainInterface $blockMap
    ) {
        $this->configurationChain = $configurationChain;
        $this->blockManager = $blockManager;
        $this->blockMap = $blockMap;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_block_view_controller', array($this, 'getBlockViewController')),
            new \Twig_SimpleFunction('get_block_edit_route', array($this, 'getBlockEditRoute')),
            new \Twig_SimpleFunction('block_is_empty', array($this, 'isBlockEmpty')),
            new \Twig_SimpleFunction('get_block_types', array($this, 'getBlockTypes')),
        );
    }

    /**
     * Get the view controller name for a block
     *
     * @param AbstractBlock $block
     *
     * @return string
     */
    public function getBlockViewController(AbstractBlock $block)
    {
        return $this->configurationChain->getConfiguration($block->getAlias())->getViewController();
    }

    /**
     * Get the edit route for a block
     *
     * @param AbstractBlock $block
     *
     * @return string
     */
    public function getBlockEditRoute(AbstractBlock $block)
    {
        return $this->configurationChain->getConfiguration($block->getAlias())->getEditRoute();
    }

    /**
     * Check if a block is empty
     *
     * @param AbstractBlock $block
     *
     * @return bool
     */
    public function isBlockEmpty(AbstractBlock $block)
    {
        return $this->blockManager->isEmpty($block);
    }

    /**
     * Get available block types
     *
     * @return array
     */
    public function getBlockTypes()
    {
        return $this->blockMap->keys();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'lp_factory_block_extension';
    }
}
