<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Services\UserService;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class ProduitExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter('stock', array($this, 'stockFunction')),
            new \Twig_SimpleFilter('ifRole', array($this, 'ifRoleUser')),
        );
    }

    public function stockFunction($depot, $produit){

        $repositoryStock = $this->em->getRepository('ProduitBundle:Stock_');

        $stock = $repositoryStock->findOneBy(array(
            'depot' => $depot,
            'produit' => $produit,

        ));


        if($stock)
            return $stock->getQuantite();
        else
            return '-';
    }

    public function ifRoleUser(User $user, $role){
        if($this->userService->isGranted($user, $role)){
            return true;
        }

        return false;
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'produit';
    }
}
