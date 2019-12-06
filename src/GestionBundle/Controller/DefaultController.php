<?php

namespace GestionBundle\Controller;

use AdminBundle\Entity\NombreConfirmation;
use GestionBundle\Entity\NumDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    private function initialiserNombreConfirmation(){
        $em = $this->getDoctrine()->getManager();

        $repositoryNombreConfirmation = $em->getRepository('AdminBundle:NombreConfirmation');

        $demandeSortie = $repositoryNombreConfirmation->findOneBy(array(
            'nomDemande' => 'sortie'
        ));

        if(! $demandeSortie){
            $demandeSortie = new NombreConfirmation();
            $demandeSortie->setNomDemande('sortie');
            $demandeSortie->setNombre(1);

            $em->persist($demandeSortie);
            $em->flush();
        }
    }



    /**
     * ----------------PAGE D'ACCUEIL-----------------
     *
     * @Route("/", name="gestion_homepage")
     */
    public function AccueilAction()
    {
        $this->initialiserNombreConfirmation();


        return $this->render('@Gestion/Default/accueil.html.twig');
    }
}
