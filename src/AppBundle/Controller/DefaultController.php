<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\NombreConfirmation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            $em->persist($nombreConfirmationSortie);

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
            $em->persist($nombreConfirmationTransfert);

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
            $em->persist($nombreConfirmationEntre);

        }

        $nombreConfirmationCommande = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'commande'
            ))
        ;

        if(!$nombreConfirmationCommande){
            $nombreConfirmationCommande = new NombreConfirmation();
            $nombreConfirmationCommande->setNombre(1);
            $nombreConfirmationCommande->setNomDemande('commande');
            $em->persist($nombreConfirmationCommande);
        }

        $nombreConfirmationExpedition = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'expedition'
            ))
        ;

        if(!$nombreConfirmationExpedition){
            $nombreConfirmationExpedition = new NombreConfirmation();
            $nombreConfirmationExpedition->setNombre(1);
            $nombreConfirmationExpedition->setNomDemande('expedition');
            $em->persist($nombreConfirmationExpedition);
        }

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

    /**
     * @Route("/montest", name="mon_test")
     */
    public function montestAction(Request $request)
    {
        $test = new \DateTime();
        $test->setDate(2020,8,3);


        return new Response(var_dump($test->format('d/m/Y')));
    }
}
