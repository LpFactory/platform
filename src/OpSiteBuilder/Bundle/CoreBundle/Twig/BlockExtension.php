<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Twig;

use OpSiteBuilder\Bundle\CoreBundle\Block\Configuration\BlockConfigurationChainInterface;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;

/**
 * Class BlockExtension
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Twig
 * @author jobou
 */
class BlockExtension extends \Twig_Extension
{
    /**
     * @var BlockConfigurationChainInterface
     */
    protected $configurationChain;

    /**
     * Constructor
     *
     * @param BlockConfigurationChainInterface $configurationChain
     */
    public function __construct(BlockConfigurationChainInterface $configurationChain)
    {
        $this->configurationChain = $configurationChain;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_block_view_controller', array($this, 'getBlockViewController')),
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
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'opsite_builder_block_extension';
    }
}
