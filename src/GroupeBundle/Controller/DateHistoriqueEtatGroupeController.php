<?php

namespace GroupeBundle\Controller;


use GroupeBundle\Entity\GroupageHistoriqueGroupe;
use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HistoriqueEtatGroupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Site controller.
 *
 * @Route("/date/historique")
 */
class DateHistoriqueEtatGroupeController extends Controller
{
    /**
     * Lists all entities.
     *
     * @Route("/", name="dateHistoriqueEtat_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dateJ = new \DateTime();
        $dateStringJ = $dateJ->format('d/m/Y');

        $dateString = $dateJ->format('d/m/Y');

        if (isset($_GET['d']) and isset($_GET['m']) and isset($_GET['y'])){
            $dateChoix = new \DateTime();
            $dateChoix->setDate($_GET['y'], $_GET['m'], $_GET['d']);
            $dateString = $dateChoix->format('d/m/Y');
            
        }

        //---------------------------  DATE DU JOUR  -------------------------------

        if ($dateStringJ == $dateString){
            return new Response('');
        }
        
        //-----------------------------/// DATE DU JOUR ///-----------------------------
        $repositoryGroupage = $em->getRepository('GroupeBundle:GroupageHistoriqueGroupe');
        $groupage = $repositoryGroupage
            ->findOneBy(array('dateString' => $dateString));


        return $this->render('@Groupe/dateHistoriqueEtat/indexHistorique.html.twig', array(
            'groupage' => $groupage,
            'historiqueEtat' => new HistoriqueEtatGroupe()
        ));


    }


    /**
     * Lists all  entities.
     *
     * @Route("/ajouter", name="dateHistoriqueEtat_new")
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listeGroupages = $em->getRepository('GroupeBundle:GroupageHistoriqueGroupe')->findAll();

        $dateJour = new \DateTime();
        $dateJour->setDate(2020,8,26);
        $testDate = 0;
        foreach($listeGroupages as $listeGroupage){
//            $listeGroupage = new GroupageHistoriqueGroupe();
            if ($dateJour->format('dmY') == $listeGroupage->getDateString())
                $testDate ++;

        }

        if ($testDate > 0){
            return new Exception('La date existe déjà');
        }

        $groupage = new GroupageHistoriqueGroupe();
        $groupage->setDateString($dateJour->format('d/m/Y'));

        $em->persist($groupage);

        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

        foreach ($groupes as $groupe){
//            $groupe = new Groupe();
            $etatHistorique = new HistoriqueEtatGroupe();
            $etatHistorique->setDate($dateJour);
            $etatHistorique->setEtat($groupe->getEtatGroupe());
            $etatHistorique->setGroupe($groupe);
            $etatHistorique->setSite($groupe->getSite());

            $etatHistorique->setGroupageHist($groupage);

            $em->persist($etatHistorique);
        }

        $em->flush();

        return new Response('Mis à jour effectuer');

    }



}
