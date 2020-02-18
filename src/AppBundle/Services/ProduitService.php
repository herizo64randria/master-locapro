<?php

namespace AppBundle\Services;

use ProduitBundle\Entity\Depot;
use ProduitBundle\Entity\Immo;
use ProduitBundle\Entity\Produit;
use Doctrine\Common\Persistence\ObjectManager;

class ProduitService
{
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function updateStockTotal(Produit $produit){
        $historiqueProduits = $produit->getHistoriqueProduits();

        $quantite = 0;
        foreach ($historiqueProduits as $historiqueProduit){
            if($historiqueProduit->getType() == 'credit')
                $quantite = $quantite + $historiqueProduit->getQuantite();

            if($historiqueProduit->getType() == 'debit')
                $quantite = $quantite - $historiqueProduit->getQuantite();
        }

        $produit->setStockTotal($quantite);

        $this->em->persist($produit);

    }

    public function getStock(Produit $produit, Depot $depot){
        $stock = $this->em->getRepository('ProduitBundle:Stock_')
            ->findOneBy(array(
                'depot' => $depot,
                'produit' => $produit
            ));

        return $stock->getQuantite();
    }

    public function emplacementImmo(Immo $immo){
        $historiqueImmos = $this->em->getRepository('ProduitBundle:HistoriqueImmo')->findBy(
            array('immo' => $immo),
            array('date' => 'asc')
        );

        foreach ($historiqueImmos as $key => $historiqueImmo){

            if ($key == (count($historiqueImmos) - 1)){
                if ($historiqueImmo->getDepot()){
                    $immo->setDepot($historiqueImmo->getDepot());
                    $immo->setSite(null);
                }
                if ($historiqueImmo->getSite()){
                    $immo->setDepot(null);
                    $immo->setSite($historiqueImmo->getSite());

                }
            }
        }

        $this->em->persist($immo);
    }

}
