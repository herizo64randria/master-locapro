<?php

namespace GroupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Site controller.
 *
 * @Route("/statistique")
 */
class StatistiqueController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/appoint/vidange", name="stat_indexAppointVidange")
     *
     */
    public function indexAppointVidangeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

        $repositoryVidange = $em->getRepository('GroupeBundle:Vidange');
        $repositoryAppoint = $em->getRepository('GroupeBundle:Appoint');

        $tableauListes = array();
        foreach ($groupes as $groupe){

            //----- L'HEURE DE MARCHE EST DEJA DANS LE GROUPE -----
            $ligne['groupe'] = $groupe;

            // ------------------ VIDANGE ------------------

            $huileVidange = 0;

            $vidanges = $repositoryVidange->findBy(array(
                'groupe' => $groupe
            ));

            foreach ($vidanges as $vidange){
                if($vidange->getHuileUtilise())
                    $huileVidange += $vidange->getHuileUtilise();
            }

            $ligne['huileVidange'] = $huileVidange;

            // ------------------///// VIDANGE /////------------------

            // ------------------ APPOINT ------------------

            $huileAppoint = 0;

            $appoints = $repositoryAppoint->findBy(array(
                'groupe' => $groupe
            ));

            foreach ($appoints as $appoint){
                if($appoint->getHuileUtilise())
                    $huileAppoint += $appoint->getHuileUtilise();
            }

            $ligne['huileAppoint'] = $huileVidange;

            // ------------------///// APPOINT /////------------------

            array_push($tableauListes, $ligne);
        }

        return $this->render('@Groupe/statistique/indexVidaneAppoint.html.twig', array(
            'tables' => $tableauListes
        ));
    }

    /**
     * POST MOIS - ANNEE
     *
     * @Route("/appoint/vidange/parMois", name="stat_byDate_indexAppointVidange")
     *
     */
    public function index_byDate_AppointVidangeAction(Request $request)
    {
        
    }

}
