<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Provider;

use OpSiteBuilder\Bundle\CoreBundle\Block\Provider\BlockDataProviderChain;
use OpSiteBuilder\Bundle\CoreBundle\Block\Provider\DefaultDataProvider;

/**
 * Class BlockDataProviderChainTest
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Provider
 * @author jobou
 */
class BlockDataProviderChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BlockDataProviderChain
     */
    protected $providerChain;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $defaultProvider = new DefaultDataProvider();

        $this->providerChain = new BlockDataProviderChain();
        $this->providerChain->addProvider($defaultProvider, 'default');
    }

    /**
     * Test addProvider
     */
    public function testAddProvider()
    {
        $testProvider = new TestProvider();
        $this->providerChain->addProvider($testProvider, 'test');

        $this->assertInstanceOf(
            'OpSiteBuilder\Bundle\CoreBundle\Tests\Block\Provider\TestProvider',
            $this->providerChain->getProvider('test')
        );
    }

    /**
     * Test getProvider return default if none found
     */
    public function testDefaultProvider()
    {
        $this->assertInstanceOf(
            'OpSiteBuilder\Bundle\CoreBundle\Block\Provider\DefaultDataProvider',
            $this->providerChain->getProvider('unknown_type')
        );
    }

    /**
     * @expectedException \LogicException
     */
    public function testDefaultProviderExists()
    {
        $providerChain = new BlockDataProviderChain();
        $providerChain->getProvider('default');
    }
}
