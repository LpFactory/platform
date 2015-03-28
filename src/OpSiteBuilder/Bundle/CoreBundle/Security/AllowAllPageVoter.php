<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

namespace OpSiteBuilder\Bundle\CoreBundle\Security;

use OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AllowAllPageVoter
 *
 * @package OpSiteBuilder\Bundle\CoreBundle\Security
 * @author jobou
 */
class AllowAllPageVoter implements VoterInterface
{
    const VIEW = 'OPSITE_BUILDER_PAGE_VIEW';
    const EDIT = 'OPSITE_BUILDER_PAGE_EDIT';
    const DELETE = 'OPSITE_BUILDER_PAGE_DELETE';

    /**
     * Get supported attributes
     *
     * @return array
     */
    protected function getSupportedAttributes()
    {
        return array(
            self::VIEW,
            self::EDIT,
            self::DELETE,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsAttribute($attribute)
    {
        return in_array($attribute, $this->getSupportedAttributes());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        $supportedClass = 'OpSiteBuilder\Bundle\CoreBundle\Model\AbstractPage';

        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }

    /**
     * Allow every one to edit page
     *
     * @param TokenInterface $token
     * @param AbstractPage   $page
     * @param array          $attributes
     *
     * @return int
     */
    public function vote(TokenInterface $token, $page, array $attributes)
    {
        // check if class of this object is supported by this voter
        if (!$this->supportsClass(get_class($page))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // set the attribute to check against
        $attribute = $attributes[0];

        // check if the given attribute is covered by this voter
        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        return VoterInterface::ACCESS_GRANTED;
    }
}
