<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Services\UserService;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class UserExtension extends \Twig_Extension
{
    private $em;
    private $userService;

    public function __construct(ObjectManager $em, UserService $userService)
    {
        $this->em = $em;
        $this->userService = $userService;
    }



    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ifRole', array($this, 'ifRoleUser')),
            new \Twig_SimpleFilter('listeDepot', array($this, 'listeDeptot')),
        );
    }



    public function ifRoleUser(User $user, $role){
        if($this->userService->isGranted($user, $role)){
            return true;
        }

        return false;
    }


    public function listeDeptot(User $user){
//        $depots = array();
//
//        if($this->ifRoleUser($user, 'ROLE_RESP')){
//            $repoDepot = $this->em->getRepository('ProduitBundle:Depot');
//            $depots = $repoDepot->findBy(array(
//                'etat' => true
//            ));
//
//            return $depots;
//        }
//
//        foreach ($user->getDepots() as $depot){
//            if($depot->getEtat() == true){
//                array_push($depots, $depot);
//            }
//        }
//
//        return $depots;

        return false;
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user';
    }
}
