<?php

namespace AppBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserService
{
    private $accessDecisionManager;

    /**
     * Constructor
     *
     * @param AccessDecisionManagerInterface $accessDecisionManager
     */
    public function __construct(AccessDecisionManagerInterface $accessDecisionManager) {
        $this->accessDecisionManager = $accessDecisionManager;
    }

    public function isGranted(User $user, $attributes, $object = null) {
        if (!is_array($attributes))
            $attributes = [$attributes];
        $token = new UsernamePasswordToken($user, 'none', 'none', $user->getRoles());
        return ($this->accessDecisionManager->decide($token, $attributes, $object));
    }



}
