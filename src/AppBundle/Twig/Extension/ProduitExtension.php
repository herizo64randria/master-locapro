<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Services\UserService;
use Doctrine\Common\Persistence\ObjectManager;
use GroupeBundle\Entity\Site;
use ProduitBundle\Entity\Depot;
use ProduitBundle\Entity\HistoriqueProduit;
use ProduitBundle\Entity\Produit;
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
            new \Twig_SimpleFilter('ifRole', array($this, 'ifRoleUser')),
            new \Twig_SimpleFilter('stockBySite', array($this, 'stockBySiteFunction')),
            new \Twig_SimpleFilter('stockByDepot', array($this, 'stockByDepotFunction')),
            new \Twig_SimpleFilter('emplacementHist', array($this, 'historiqueProduitEmplacement')),
            new \Twig_SimpleFilter('ifProdInListePiece', array($this, 'ifProdInListePieceFunction')),
        );
    }

    public function stockBySiteFunction(Site $site, Produit $produit){
        $repositoryStock = $this->em->getRepository('ProduitBundle:Stock_');

        $stock = $repositoryStock->findOneBy(array(
            'site' => $site,
            'produit' => $produit,

        ));


        if($stock)
            return $stock->getQuantite();
        else
            return '-';
    }

    public function stockByDepotFunction(Depot $depot, Produit $produit){
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

    public function historiqueProduitEmplacement(HistoriqueProduit $historiqueProduit){
        $emplacement = '';

        if ($historiqueProduit->getSite()){
            $emplacement = '(S)'.$historiqueProduit->getSite()->getEmplacement();
        }
        if ($historiqueProduit->getDepot()){
            $emplacement = '(D)'.$historiqueProduit->getDepot()->getNom();
        }

        return $emplacement;
    }

    public function ifProdInListePieceFunction(Produit $produit){
        $repositoryListePiece = $this->em->getRepository('GroupeBundle:ListePiece');
        $listePiece = $repositoryListePiece->findOneBy(array(
            'produit' => $produit
        ));

        if($listePiece)
            return true;
        else
            return false
        ;

    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'produit';
    }
}
