<?php

namespace ApiExterneBundle\Controller;

use GroupeBundle\Entity\Groupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProblemeAPIController extends Controller
{
    /**
     * @Route("/probleme/groupe/{numero}")
     */
    public function indexAction(Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryProbleme = $em->getRepository('GroupeBundle:Probleme');

        $problemes = $repositoryProbleme->findBy(
            array('groupe' => $groupe),
            array('dateSignalement' => 'desc')
        );

        $listeProbleme = array();
        foreach ($problemes as $probleme){
            $pbm = array(
                'numero' => $probleme->getNumero(),
                'lien' => $this->generateUrl('probleme_show', array("id" => $probleme->getId()), UrlGeneratorInterface::ABSOLUTE_URL)
            );
            array_push($listeProbleme, $pbm);
        }

        $response = new Response();
        $response->setContent(json_encode($listeProbleme));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'text/html');
        return $response;

    }
}
