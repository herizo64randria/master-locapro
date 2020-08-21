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
        $minutes = 0;

        foreach ($listeHeures as $listeHeure){
            $heures = $heures+ $listeHeure->getHeure();
            $minutes = $minutes + $listeHeure->getMinute();
        }

        if ($groupe->getPremierDemarrage()){
            $heures += $groupe->getPremierDemarrage();
        }

        $minutes = ($heures * 60) + $minutes;

        $valueHm = array(
            'heure' => intval($minutes / 60),
            'minute' => fmod($minutes, 60)
        );

        $groupe->setHeureMarche($valueHm['heure']);
        $groupe->setMinuteMarche($valueHm['minute']);
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
