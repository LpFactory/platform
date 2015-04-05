<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\Factory;

use OpSiteBuilder\Bundle\CoreBundle\Entity\Page;
use OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\RoutingHelper;
use OpSiteBuilder\Bundle\CoreBundle\Routing\Factory\PageRouteFactory;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route;

/**
 * Class PageRouteFactoryTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Routing\Factory
 * @author jobou
 */
class PageRouteFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Build a page route factory for testing
     *
     * @param mixed $repositoryResult
     * @param bool $strategyResult
     *
     * @return PageRouteFactory
     */
    public function buildFactory($repositoryResult, $strategyResult)
    {
        $page = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Entity\Page');
        $page
            ->method('getId')
            ->willReturn(56);

        $repository = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Model\Repository\PageRepositoryInterface');
        $repository
            ->method('getCachedPath')
            ->willReturn($repositoryResult);
        $repository
            ->method('find')
            ->willReturn($page);

        $strategy = $this
            ->getMockBuilder('OpSiteBuilder\Bundle\CoreBundle\Routing\Strategy\AbstractTreeStrategy')
            ->disableOriginalConstructor()
            ->getMock();
        $strategy
            ->method('isHomeTreeRoot')
            ->willReturn($strategyResult);

        return new PageRouteFactory($repository, $strategy);
    }

    /**
     * Validate the edit route result
     *
     * @param string $path
     * @param Route $result
     */
    public function validateEditResult($path, $result)
    {
        $this->assertEquals($path, $result->getPath());
        $this->assertEquals('opsite_page_tree_edit_56', $result->getName());
        $defaults = $result->getDefaults();
        $this->assertArrayHasKey('_controller', $defaults);
        $this->assertEquals('OpSiteBuilderCoreBundle:Page:edit', $defaults['_controller']);
    }

    /**
     * Validate the view route result
     *
     * @param string $path
     * @param Route $result
     */
    public function validateViewResult($path, $result)
    {
        $this->assertEquals($path, $result->getPath());
        $this->assertEquals('opsite_page_tree_view_56', $result->getName());
        $defaults = $result->getDefaults();
        $this->assertArrayHasKey('_controller', $defaults);
        $this->assertEquals('OpSiteBuilderCoreBundle:Page:index', $defaults['_controller']);
    }

    /**
     * Test create and createFromId
     */
    public function testCreate()
    {
        $editConfiguration = RoutingHelper::createEditConfiguration();
        $viewConfiguration = RoutingHelper::createViewConfiguration();

        $page = $this->getMock('OpSiteBuilder\Bundle\CoreBundle\Entity\Page');
        $page
            ->method('getId')
            ->willReturn(56);

        // Edit homepage
        $factory = $this->buildFactory(array(), true);
        $result = $factory->create($editConfiguration, $page);
        $this->validateEditResult('/edit', $result);

        // View homepage
        $factory = $this->buildFactory(array(), true);
        $result = $factory->create($viewConfiguration, $page);
        $this->validateViewResult('/', $result);

        // Disable homepage
        $factory = $this->buildFactory(array(), false);
        $result = $factory->create($viewConfiguration, $page);
        $this->validateViewResult('', $result);

        $home = new Page();
        $home->setSlug('home');

        $child = new Page();
        $child->setSlug('child1');

        $secondChild = new Page();
        $secondChild->setSlug('child2');

        $path = array($home, $child, $secondChild);

        // Deep node page
        $factory = $this->buildFactory($path, false);
        $result = $factory->create($viewConfiguration, $page);
        $this->validateViewResult('/child1/child2', $result);

        $result = $factory->create($editConfiguration, $page);
        $this->validateEditResult('/child1/child2/edit', $result);

        $result = $factory->createFromId($viewConfiguration, 56);
        $this->validateViewResult('/child1/child2', $result);

        $result = $factory->createFromId($editConfiguration, 56);
        $this->validateEditResult('/child1/child2/edit', $result);
    }
}
