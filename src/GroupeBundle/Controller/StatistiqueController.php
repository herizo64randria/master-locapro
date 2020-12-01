<?php

namespace GroupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

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

            $ligne['huileAppoint'] = $huileAppoint;

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
        if($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();

            $mois = (int)$_POST['moisStat'];
            $annee = (int)$_POST['anneeStat'];

            $_dateDebut = date("d/m/Y", mktime(0, 0, 0, $mois, 1 ,$annee));
            $_dateFin = date("d/m/Y", mktime(0, 0, 0, $mois +1, 0, $annee));

            $dateDebut = \DateTime::createFromFormat('d/m/Y', $_dateDebut);
            $dateDebut->setTime(0,0);

            $dateFin = \DateTime::createFromFormat('d/m/Y', $_dateFin);
            $dateFin->setTime(23,59, 59);

            $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

            $repositoryVidange = $em->getRepository('GroupeBundle:Vidange');
            $repositoryAppoint = $em->getRepository('GroupeBundle:Appoint');
            $repositoryHeureMarche = $em->getRepository('GroupeBundle:HeureMarche');

            $tableauListes = array();
            foreach ($groupes as $groupe){

                //----- L'HEURE DE MARCHE EST DEJA DANS LE GROUPE -----
                $ligne['groupe'] = $groupe;

                // ------------------ VIDANGE ------------------

                $huileVidange = 0;

                $vidanges = $repositoryVidange->findByDateAndGroupe($groupe, $dateDebut, $dateFin);

                foreach ($vidanges as $vidange){
                    if($vidange->getHuileUtilise())
                        $huileVidange += $vidange->getHuileUtilise();
                }

                $ligne['huileVidange'] = $huileVidange;

                // ------------------///// VIDANGE /////------------------

                // ------------------ APPOINT ------------------

                $huileAppoint = 0;

                $appoints = $repositoryAppoint->findByDateAndGroupe($groupe, $dateDebut, $dateFin);

                foreach ($appoints as $appoint){
                    if($appoint->getHuileUtilise())
                        $huileAppoint += $appoint->getHuileUtilise();
                }

                $ligne['huileAppoint'] = $huileAppoint;

                // ------------------///// APPOINT /////------------------

                // ------------------ HEURE DE MARCHE ------------------

                $heureMarche = 0;
                $minuteMarche = 0;

                $heureMarches = $repositoryHeureMarche->findByDateAndGroupe($groupe, $dateDebut, $dateFin);

                foreach ($heureMarches as $heureM){
                    if($heureM->getHeure())
                        $heureMarche += $heureM->getHeure();

                    if($heureM->getMinute())
                        $minuteMarche += $heureM->getMinute();
                }

                $ligne['heureMarche'] = $heureMarche;
                $ligne['minuteMarche'] = $minuteMarche;

                // ------------------///// HEURE DE MARCHE /////------------------

                array_push($tableauListes, $ligne);
            }

            return $this->render('@Groupe/statistique/indexByDateVidaneAppoint.html.twig', array(
                'tables' => $tableauListes,
                'dateDebut' => $dateDebut
            ));


        }else
           throw new Exception('Erreur 404 NOT-FOUND');
    }

}
