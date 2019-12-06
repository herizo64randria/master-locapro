<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\NombreConfirmation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    private function initialisationNombreConfirmation(){
        $em = $this->getDoctrine()->getManager();

        $nombreConfirmationSortie = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'sortie'
            ))
        ;

        if(!$nombreConfirmationSortie){
            $nombreConfirmationSortie = new NombreConfirmation();
            $nombreConfirmationSortie->setNombre(1);
            $nombreConfirmationSortie->setNomDemande('sortie');
        }

        $nombreConfirmationTransfert = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'transfert'
            ))
        ;

        if(!$nombreConfirmationTransfert){
            $nombreConfirmationTransfert = new NombreConfirmation();
            $nombreConfirmationTransfert->setNombre(1);
            $nombreConfirmationTransfert->setNomDemande('transfert');
        }

        $nombreConfirmationEntre = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'entre'
            ))
        ;

        if(!$nombreConfirmationEntre){
            $nombreConfirmationEntre = new NombreConfirmation();
            $nombreConfirmationEntre->setNombre(1);
            $nombreConfirmationEntre->setNomDemande('entre');
        }

        $em->persist($nombreConfirmationEntre);
        $em->persist($nombreConfirmationSortie);
        $em->persist($nombreConfirmationTransfert);

        $em->flush();

    }


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->initialisationNombreConfirmation();

        // replace this example code with whatever you need
        return $this->render('default/accueil.html.twig', array(

        ));
    }
}
