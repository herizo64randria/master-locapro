<?php

namespace AppBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use GroupeBundle\Entity\Groupe;

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

        $groupe->setHeureMarche($heures);
        $em->persist($groupe);
        $em->flush();

    }

}
