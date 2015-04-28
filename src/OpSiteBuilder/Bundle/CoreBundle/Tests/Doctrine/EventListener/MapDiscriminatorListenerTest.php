<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Doctrine\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use OpSiteBuilder\Bundle\CoreBundle\Doctrine\EventListener\MapDiscriminatorListener;

/**
 * Class MapDiscriminatorListenerTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Doctrine\EventListener
 * @author jobou
 */
class MapDiscriminatorListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LoadClassMetadataEventArgs
     */
    protected $event;

    /**
     * Set up the event
     */
    public function setUp()
    {
        $manager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $metadata = new ClassMetadata('OpSiteBuilder\Bundle\CoreBundle\Entity\Page');
        $this->event = new LoadClassMetadataEventArgs($metadata, $manager);
    }

    /**
     * Test load class metadata
     */
    public function testLoadClassMetadata()
    {
        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Doctrine\EventListener\DoctrineDiscriminatorProviderInterface');
        $blockChainMock
            ->expects($this->once())
            ->method('getDiscriminatorMap')
            ->willReturn(array(
                'test_block' => 'OpSiteBuilder\Bundle\CoreBundle\Tests\Entity\BlockTest',
                'test_page' => 'OpSiteBuilder\Bundle\CoreBundle\Tests\Entity\PageTest'
            ));

        $this->assertEquals(0, count($this->event->getClassMetadata()->discriminatorMap));
        $listener = new MapDiscriminatorListener(
            'OpSiteBuilder\Bundle\CoreBundle\Entity\Page',
            $blockChainMock
        );

        $listener->loadClassMetadata($this->event);
        $this->assertEquals(2, count($this->event->getClassMetadata()->discriminatorMap));
    }

    /**
     * Test load class metadata unknown configuration
     *
     * @expectedException Doctrine\ORM\Mapping\MappingException
     */
    public function testUnknownClassLoadClassMetadata()
    {
        $blockChainMock = $this
            ->getMock('OpSiteBuilder\Bundle\CoreBundle\Doctrine\EventListener\DoctrineDiscriminatorProviderInterface');
        $blockChainMock
            ->expects($this->once())
            ->method('getDiscriminatorMap')
            ->willReturn(array('test' => 'test'));

        $listener = new MapDiscriminatorListener(
            'OpSiteBuilder\Bundle\CoreBundle\Entity\Page',
            $blockChainMock
        );
        $listener->loadClassMetadata($this->event);
    }
}
