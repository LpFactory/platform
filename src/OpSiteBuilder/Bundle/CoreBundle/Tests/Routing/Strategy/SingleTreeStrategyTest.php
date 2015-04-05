<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\Strategy;

use OpSiteBuilder\Bundle\CoreBundle\Entity\Page;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy\SingleTreeStrategy;

/**
 * Class SingleTreeStrategyTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\Strategy
 * @author jobou
 */
class SingleTreeStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test isHomeTreeRoot
     */
    public function testIsHomeTreeRoot()
    {
        $repository = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Model\Repository\PageRepositoryInterface');

        $strategy = new SingleTreeStrategy($repository, true);
        $this->assertTrue($strategy->isHomeTreeRoot());

        $strategy = new SingleTreeStrategy($repository, false);
        $this->assertFalse($strategy->isHomeTreeRoot());
    }

    /**
     * Test getPage
     */
    public function testGetPage()
    {
        // Root node for getSingleRootNode method
        $rootPage = new Page();
        $rootPage
            ->setSlug('home');

        // Page node for getPageInTree method
        $page = new Page();
        $page
            ->setSlug('child-page');

        $repository = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Model\Repository\PageRepositoryInterface');
        $repository
            ->expects($this->any())
            ->method('getSingleRootNode')
            ->willReturn($rootPage);
        $repository
            ->expects($this->any())
            ->method('getPageInTree')
            ->willReturn($page);

        $strategy = new SingleTreeStrategy($repository, true);

        // Test that strategy return built root node
        $this->assertEquals($rootPage, $strategy->getRootNode('opsitebuilder.localhost'));

        // Homepage test. Return root node
        $result = $strategy->getPage("", "opsitebuilder.localhost");
        $this->assertEquals(array($rootPage), $result);

        // Page node found from slug
        $result = $strategy->getPage('child-page', "opsitebuilder.localhost");
        $this->assertEquals($page, $result);
    }

    /**
     * Test getDeepestPageSlug
     */
    public function testGetDeepestPageSlug()
    {
        $repository = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Model\Repository\PageRepositoryInterface');
        $strategy = new SingleTreeStrategy($repository, true);

        $this->assertEquals('deepest-node', $strategy->getDeepestPageSlug('/test/child/deepest-node'));
        $this->assertEquals('', $strategy->getDeepestPageSlug('/'));
    }
}
