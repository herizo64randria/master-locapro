<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HeureMarche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\GroupeService;
use GroupeBundle\Entity\HistoriqueGroupe;

/**
 * Groupe controller.
 *
 * @Route("marche")
 */
class HeureMarcheController extends Controller
{

    /**
     * Lists all groupe entities.
     *
     * @Route("/liste-heure-marche", name="heureMarche_index")
     *
     */
    public function indexHeureMarcheAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

        return $this->render('@Groupe/heureMarche/indexHeureMarches.html.twig', array(
            'groupes' => $groupes,
        ));
    }

    /**
     * Lists all groupe entities.
     *
     * @Route("/voir-liste-heure-marche/BA24F{id}64A", name="heureMarche_show")
     *
     */
    public function showListHeureMarcheAction(Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('GroupeBundle:HeureMarche')->findBy(array('groupe'=>$groupe));

        return $this->render('@Groupe/heureMarche/showListeHeureMarche.html.twig', array(
            'groupes' => $groupes,'groupe' => $groupe,
        ));
    }

    /**
     * add heures groupe entities.
     *
     * @Route("/add-heures", name="heureMarche_plusieurAjout")
     *
     */
    public function addHeuresAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

        if($request->getMethod()=='POST')
        {
//            return new Response(var_dump($_POST['check']));

            foreach ($_POST['check'] as $ckeckVal)
            {
                $dated = \DateTime::createFromFormat('d/m/Y',$_POST['debut'.$ckeckVal]);
                $datef = \DateTime::createFromFormat('d/m/Y',$_POST['fin'.$ckeckVal]);
                $date = new \DateTime();

                if($dated=="" or $datef=="")
                    throw new Exception('Erreur! Veuillez vérifier les dates!');
                if($dated > $datef)
                    throw new Exception('Erreur! Veuillez vérifier les dates!');

                if($_POST['debut'.$ckeckVal]!="" and $_POST['fin'.$ckeckVal]!="" and $_POST['heure'.$ckeckVal]!="" ){
                    $groupe= $em->getRepository('GroupeBundle:Groupe')->findOneBy(array('id'=>$ckeckVal));
                    $heuremarche = new HeureMarche();
                    $heuremarche->setGroupe($groupe);

                    $heuremarche->setDatedebut($dated);
                    $heuremarche->setDatefin($datef);
                    $heuremarche->setHeure($_POST['heure'.$ckeckVal]);
                    $heuremarche->setPuissance($_POST['puissance'.$ckeckVal]);
                    $historiqueGroupe = new HistoriqueGroupe();

                    $historiqueGroupe->setDate($date);
                    $historiqueGroupe->setHeureMarche($heuremarche);
                    $historiqueGroupe->setGroupe($groupe);

                    $em->persist($heuremarche);
                    $em->persist($historiqueGroupe);
                    $em->flush();
                    $groupeService= new GroupeService();
                    $groupeService->calculHeure($groupe,$em);

                }
            }

            return $this->redirectToRoute('heureMarche_index');
        }
        return $this->render('@Groupe/heureMarche/addHeureAll.html.twig', array(
            'groupes' => $groupes,
        ));
    }
    /**
     * add heures groupe entities.
     *
     * @Route("/add-heure", name="heureMarche_simpleAjout")
     *
     */
    public function addHeureAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $groupes= $em->getRepository('GroupeBundle:Groupe')->findAll();
        if($request->getMethod()=='POST')
        {

                $dated = \DateTime::createFromFormat('d/m/Y',$_POST['datedebut']);
                $datef = \DateTime::createFromFormat('d/m/Y',$_POST['datefin']);
                $date = new \DateTime();
                if($dated=="" or $datef=="")
                    throw new Exception('Erreur! Veuillez vérifier les dates!');
                if($dated > $datef)
                    throw new Exception('Erreur! Veuillez vérifier les dates!');

                $groupe= $em->getRepository('GroupeBundle:Groupe')->findOneBy(array('id'=>$_POST['groupe']));
                $heuremarche = new HeureMarche();
                $heuremarche->setGroupe($groupe);
                $heuremarche->setDatedebut($dated);
                $heuremarche->setDatefin($datef);
                $heuremarche->setHeure($_POST['heure']);
                $heuremarche->setPuissance($_POST['puissance']);
                $historiqueGroupe = new HistoriqueGroupe();
                $historiqueGroupe->setDate($date);
                $historiqueGroupe->setHeureMarche($heuremarche);
                $historiqueGroupe->setGroupe($groupe);

                $em->persist($heuremarche);
                $em->persist($historiqueGroupe);
                $em->flush();
                $groupeService= new GroupeService();
                $groupeService->calculHeure($groupe,$em);


            return $this->redirectToRoute('heureMarche_show', array('id' => $groupe->getId()));
        }
        return $this->render('@Groupe/heureMarche/addHeureSolo.html.twig',array('groupes'=>$groupes));

    }
    /**
     * add heures groupe entities.
     *
     * @Route("/add-heure-groupe/45{id}5456", name="heureMarche_simpleAjoutByGroupe")
     *
     */
    public function addHeureByGroupeAction(Request $request,Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();


        if($request->getMethod()=='POST')
        {

            $dated = \DateTime::createFromFormat('d/m/Y',$_POST['datedebut']);
            $datef = \DateTime::createFromFormat('d/m/Y',$_POST['datefin']);
            $date = new \DateTime();
            if($dated=="" or $datef=="")
                throw new Exception('Erreur! Veuillez vérifier les dates!');
            if($dated > $datef)
                throw new Exception('Erreur! Veuillez vérifier les dates!');

            $heuremarche = new HeureMarche();
            $heuremarche->setGroupe($groupe);
            $heuremarche->setDatedebut($dated);
            $heuremarche->setDatefin($datef);
            $heuremarche->setHeure($_POST['heure']);
            $heuremarche->setPuissance($_POST['puissance']);
            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($date);
            $historiqueGroupe->setHeureMarche($heuremarche);
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($heuremarche);
            $em->persist($historiqueGroupe);
            $em->flush();
            $groupeService= new GroupeService();
            $groupeService->calculHeure($groupe,$em);


            return $this->redirectToRoute('heureMarche_show', array('id' => $groupe->getId()));
        }
        return $this->render('@Groupe/heureMarche/addHeureByGroupe.html.twig',array('groupe'=>$groupe));

    }
    /**
     * Lists all groupe entities.
     *
     * @Route("/détails/par-date", name="heureMarche_indexByDate")
     *
     */
    public function indexByDateAction(Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();

            $repoGroupe = $em->getRepository('GroupeBundle:Groupe');
            $groupes = $repoGroupe->findAll();

            $dateDebut = \DateTime::createFromFormat('d/m/Y',$_POST['dateDebut']);
            $dateFin = \DateTime::createFromFormat('d/m/Y',$_POST['dateFin']);

//            return new Response(var_dump($dateDebut->diff($dateFin)));

            return $this->render('@Groupe/heureMarche/indexByDates.html.twig',array(
                'groupes' => $groupes,
                'dateDebut' => $dateDebut,
                'dateFin' => $dateFin,
            ));

        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }



}
