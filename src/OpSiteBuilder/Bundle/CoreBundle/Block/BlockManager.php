<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Block;

use Doctrine\Common\Persistence\ObjectManager;
use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractBlock;
use OpSiteBuilder\Bundle\CoreBundle\Block\Provider\BlockDataProviderChainInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class BlockManager
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Block
 * @author jobou
 */
class BlockManager implements BlockManagerInterface
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var array
     */
    protected $isEmpty = array();

    /**
     * @var BlockDataProviderChainInterface
     */
    protected $providerChain;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param BlockDataProviderChainInterface $providerChain
     * @param ObjectManager                   $manager
     * @param EngineInterface                 $templating
     */
    public function __construct(
        BlockDataProviderChainInterface $providerChain,
        ObjectManager $manager,
        EngineInterface $templating
    ) {
        $this->providerChain = $providerChain;
        $this->manager = $manager;
        $this->templating = $templating;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty(AbstractBlock $block)
    {
        if (isset($this->isEmpty[$block->getId()])) {
            return $this->isEmpty[$block->getId()];
        }

        $empty = $block->isEmpty();
        // If no empty state, use block manager
        if ($empty === null) {
            $data = $this->getData($block);
            $empty = empty($data);
        }

        return $this->isEmpty[$block->getId()] = $empty;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(AbstractBlock $block)
    {
        // Get data if not already done before
        if (!isset($this->data[$block->getId()])) {
            $provider = $this->providerChain->getProvider($block->getAlias());
            $this->data[$block->getId()] = $provider->getData($block);
        }

        // Return data
        return $this->data[$block->getId()];
    }

    /**
     * {@inheritdoc}
     */
    public function save(AbstractBlock $block, $flush = true)
    {
        $this->manager->persist($block);
        if ($flush) {
            $this->manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove(AbstractBlock $block, $flush = true)
    {
        $this->manager->remove($block);
        if ($flush) {
            $this->manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderView(AbstractBlock $block, $edit = false)
    {
        return $this->templating->render('OpSiteBuilderWebBundle:Block/view:default.html.twig', array(
            'block' => $block,
            'data' => $this->getData($block),
            'edit' => $edit
        ));
    }
}
