<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tests\Security;

use LpFactory\Bundle\CoreBundle\Entity\Block;
use LpFactory\Bundle\CoreBundle\Entity\Page;
use LpFactory\Bundle\CoreBundle\Security\AllowAllPageVoter;
use LpFactory\Bundle\CoreBundle\Security\SecurityAttributes;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * Class AllowAllPageVoterTest
 *
 * @package LpFactory\Bundle\CoreBundle\Tests\Security
 * @author jobou
 */
class AllowAllPageVoterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the allow all page voter supports page security attributes
     */
    public function testSupportsAttribute()
    {
        $voter = new AllowAllPageVoter();
        $this->assertTrue($voter->supportsAttribute(SecurityAttributes::PAGE_VIEW));
        $this->assertTrue($voter->supportsAttribute(SecurityAttributes::PAGE_EDIT));
        $this->assertTrue($voter->supportsAttribute(SecurityAttributes::PAGE_DELETE));

        $this->assertFalse($voter->supportsAttribute(SecurityAttributes::BLOCK_VIEW));
        $this->assertFalse($voter->supportsAttribute(SecurityAttributes::BLOCK_EDIT));
        $this->assertFalse($voter->supportsAttribute(SecurityAttributes::BLOCK_DELETE));
        $this->assertFalse($voter->supportsAttribute('UNKNOWN_ATTRIBUTE'));
    }

    /**
     * Test that the allow all page voter supports Page entities
     */
    public function testSupportsClass()
    {
        $voter = new AllowAllPageVoter();

        $this->assertTrue($voter->supportsClass(get_class(new Page())));
        $this->assertTrue($voter->supportsClass('LpFactory\Bundle\CoreBundle\Model\AbstractPage'));

        $this->assertFalse($voter->supportsClass('LpFactory\Bundle\CoreBundle\Model\AbstractBlock'));
    }

    /**
     * Test that voter always grant access for Page entities
     */
    public function testVote()
    {
        $voter = new AllowAllPageVoter();
        $token = $this->getMock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');

        $supportedAttributes = array(SecurityAttributes::PAGE_VIEW);
        $unsupportedAttributes = array('UNKNOWN_ATTRIBUTE');

        $supportedEntity = new Page();
        $unsupportedEntity = new SecurityAttributes();

        $this->assertEquals(
            VoterInterface::ACCESS_GRANTED,
            $voter->vote($token, $supportedEntity, $supportedAttributes)
        );

        $this->assertEquals(
            VoterInterface::ACCESS_ABSTAIN,
            $voter->vote($token, $unsupportedEntity, $supportedAttributes)
        );

        $this->assertEquals(
            VoterInterface::ACCESS_ABSTAIN,
            $voter->vote($token, $supportedEntity, $unsupportedAttributes)
        );
    }
}
