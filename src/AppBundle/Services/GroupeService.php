<?php

namespace AppBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HeureMarche;

class GroupeService
{

    public  function calculHeure(Groupe $groupe,ObjectManager $em){

        $listeHeures = $em->getRepository('GroupeBundle:HeureMarche')->findBy(
            array('groupe' => $groupe)
        );

        $heures = 0;
        $puissances = 0;

        foreach ($listeHeures as $listeHeure){


            $heures = $heures+ $listeHeure->getHeure();


        }

        if ($groupe->getPremierDemarrage()){
            $heures += $groupe->getPremierDemarrage();
        }

        $groupe->setHeureMarche($heures);
        $em->persist($groupe);

    }

    public function heureMarcheEtPuissanceDetail(ObjectManager $em, HeureMarche $heureMarche){
        $totalHeure = 0;
        $puissances = array();
        foreach ($heureMarche->getSousHeures() as $sousHeure){
            $totalHeure += $sousHeure->getHeure();
            if ($sousHeure->getPuissance()){
                array_push($puissances, $sousHeure->getPuissance());

            }
        }

        $heureMarche->setHeure($totalHeure);

        if (count($puissances) > 0){
            $puissanceMoyenne = array_sum($puissances) / count($puissances);
            $heureMarche->setPuissance($puissanceMoyenne);
        }



        $em->persist($heureMarche);

        $em->flush();

        $this->calculHeure($heureMarche->getGroupe(), $em);

    }



}
