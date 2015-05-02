<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LpFactory\Block\TextBlockBundle\Entity\TextBlock;
use LpFactory\Bundle\CoreBundle\Entity\Page;
use LpFactory\Bundle\CoreBundle\Model\AbstractPage;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadPageData
 *
 * @package LpFactory\Bundle\TestBundle\DataFixtures\ORM
 * @author jobou
 */
class LoadPageData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $pageClass = $this->container->getParameter('lpfactory.entity.page.class');

        foreach ($this->getData() as $item) {
            /** @var $page AbstractPage */
            $page = new $pageClass();
            $page->setTitle($item['title']);

            if ($item['parent'] !== null) {
                $page->setParent($this->getReference('page-' . $item['parent']));
            }

            $this->createBlocks($page, $manager);

            $this->addReference('page-' . $item['key'], $page);

            $manager->persist($page);
            $manager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * Page data
     *
     * @return array
     */
    public function getData()
    {
        return array(
            array(
                'title' => 'Home',
                'key' => 'home',
                'parent' => null
            ),
            array(
                'title' => 'Child 1',
                'key' => 'child_1',
                'parent' => 'home'
            ),
            array(
                'title' => 'Child 2',
                'key' => 'child_2',
                'parent' => 'home'
            ),
            array(
                'title' => 'Child 1 of 1',
                'key' => 'child_1_1',
                'parent' => 'child_1'
            ),
            array(
                'title' => 'Child 1 of 1.1',
                'key' => 'child_1_1_1',
                'parent' => 'child_1_1'
            )
        );
    }

    /**
     * Create blocks in page
     *
     * @param AbstractPage  $page
     * @param ObjectManager $manager
     */
    protected function createBlocks(AbstractPage $page, ObjectManager $manager)
    {
        for ($i = 1; $i < 5; $i++) {
            $textBlock = new TextBlock();
            $textBlock->setTitle('title '.$i);
            $textBlock->setContent('text '.uniqid());
            $page->addBlock($textBlock);

            $manager->persist($textBlock);
        }
    }
}
