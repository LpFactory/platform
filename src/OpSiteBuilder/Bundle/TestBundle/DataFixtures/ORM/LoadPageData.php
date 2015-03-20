<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpSiteBuilder\Bundle\CoreBundle\Entity\Page;

/**
 * Class LoadPageData
 *
 * @package OpSiteBuilder\Bundle\TestBundle\DataFixtures\ORM
 * @author jobou
 */
class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $item) {
            $page = new Page();
            $page->setTitle($item['title']);

            if ($item['parent'] !== null) {
                $page->setParent($this->getReference('page-' . $item['parent']));
            }

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
}