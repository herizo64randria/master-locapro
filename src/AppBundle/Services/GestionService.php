<?php

namespace AppBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\Deplacement;
use GestionBundle\Entity\Sortie;

class GestionService
{
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function testErreurLigne(Sortie $sortie){
        $erreur = 0;

        $serviceProduit = new ProduitService($this->em);

        foreach ($sortie->getLigneSorties() as $ligneSortie){
            if($ligneSortie->getQuantite() > $serviceProduit->getStock($ligneSortie->getProduit() ,$sortie->getDepot()))
                $erreur ++;
        }

        return $erreur;
    }

    public function testErreurLigne1(Deplacement $deplacement){
        $erreur1 = 0;

        $serviceProduit = new ProduitService($this->em);

        foreach ($deplacement->getLignedeplacement() as $ligneDeplacement){
            if($ligneDeplacement->getQuantite() > $serviceProduit->getStock($ligneDeplacement->getProduit() ,$deplacement->getSourcedepot()))
                $erreur1 ++;
        }

        return $erreur1;
    }
}
