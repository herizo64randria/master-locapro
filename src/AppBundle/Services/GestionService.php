<?php

namespace AppBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\Deplacement;
use GestionBundle\Entity\Sortie;
use ProduitBundle\Entity\Stock_;
use Symfony\Component\Config\Definition\Exception\Exception;

class GestionService
{
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function testErreurLigneSortie(Sortie $sortie){
        $erreur = 0;

        $repositoryStock = $this->em->getRepository(Stock_::class);

        foreach ($sortie->getLigneSorties() as $ligneSortie){

            //-----------------TEST DU STOCK-----------------
            $produit = $ligneSortie->getProduit();
            $stock = null;
            if ($sortie->getDepot()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'depot' => $sortie->getDepot()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$produit->getReference());
                }
            }

            if ($sortie->getSite()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'site' => $sortie->getSite()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le site: '.$produit->getReference());
                }
            }

            $quantiteEnStock = $stock->getQuantite();


            if($ligneSortie->getQuantite() > $quantiteEnStock)
                $erreur ++;
        }

        return $erreur;
    }

    public function testErreurLigneDeplacement(Deplacement $deplacement){
        $erreur = 0;

        $repositoryStock = $this->em->getRepository(Stock_::class);

        foreach ($deplacement->getLignedeplacement() as $ligneSortie){

            //-----------------TEST DU STOCK-----------------
            $produit = $ligneSortie->getProduit();
            $stock = null;
            if ($deplacement->getSourcedepot()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'depot' => $deplacement->getSourcedepot()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$produit->getReference());
                }
            }

            if ($deplacement->getSourcesite()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'site' => $deplacement->getSourcesite()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le site: '.$produit->getReference());
                }
            }

            $quantiteEnStock = $stock->getQuantite();


            if($ligneSortie->getQuantite() > $quantiteEnStock)
                $erreur ++;
        }

        return $erreur;
    }

   
}
