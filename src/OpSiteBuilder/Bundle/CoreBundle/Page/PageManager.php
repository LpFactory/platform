<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Page;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PageManager
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Page
 * @author jobou
 */
class PageManager implements PageManagerInterface
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(AbstractPage $page, $flush = true)
    {
        $this->manager->persist($page);
        if ($flush) {
            $this->manager->flush();
        }
    }
}
