<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HeureMarche;
use GroupeBundle\Entity\SousHeureMarche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\GroupeService;
use GroupeBundle\Entity\HistoriqueGroupe;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Groupe controller.
 *
 * @Route("heure-de-marche")
 */
class GroupeHeureMarcheController extends Controller
{

    /**
     * Lists all groupe entities.
     *
     * @Route("/liste-groupe", name="GroupeHeureMarche_index")
     *
     */
    public function indexHeureMarcheAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

        return $this->render('@Groupe/GroupeHeureMarche/index.html.twig', array(
            'groupes' => $groupes,
        ));
    }

    /**
     * Lists all groupe entities.
     *
     * @Route("/afficher-details/{id}", name="GroupeHeureMarche_detailHeureGroupe")
     *
     */
    public function detailsHeureGroupeAction(Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        $heureMarches = $em->getRepository('GroupeBundle:HeureMarche')->findBy(array('groupe'=>$groupe));

        return $this->render('@Groupe/GroupeHeureMarche/detailHeureGroupe.html.twig', array(
            'heureMarches' => $heureMarches,
            'groupe' => $groupe,
        ));
    }

    /**
     * add heures groupe entities.
     *
     * @Route("/add-heure-groupe/45{id}5456", name="GroupeHeureMarche_addHeureByGroupe")
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
            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($date);
            $historiqueGroupe->setHeureMarche($heuremarche);
            $historiqueGroupe->setGroupe($groupe);

            if (isset($_POST['puissance'])){
                $heuremarche->setPuissance($_POST['puissance']);
            }
            if (isset($_POST['production'])){
                $heuremarche->setProduction($_POST['production']);
            }
            if (isset($_POST['consomation'])){
                $heuremarche->setConsomation($_POST['consomation']);
            }
            if (isset($_POST['csp'])){
                $heuremarche->setCsp($_POST['csp']);
            }

            $em->persist($heuremarche);
            $em->persist($historiqueGroupe);
            $em->flush();
            $groupeService= new GroupeService();
            $groupeService->calculHeure($groupe,$em);
            $em->flush();

            return $this->redirectToRoute('GroupeHeureMarche_detailHeureGroupe', array('id' => $groupe->getId()));
        }
        return $this->render('@Groupe/heureMarche/addHeureByGroupe.html.twig',array('groupe'=>$groupe));
    }


    /**
     * add heures groupe entities.
     *
     * @Route("/add-heure-/500{id}/détail", name="GroupeHeureMarche_addHeureDetail")
     *
     */
    public function addHeureDetailAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST'){
            $date = \DateTime::createFromFormat('d/m/Y', $_POST['dateHeureMarche']);
            $heuremarche = new HeureMarche();
            $heuremarche->setGroupe($groupe);
            $heuremarche->setDatedebut($date);
            $heuremarche->setDatefin($date);
            $heuremarche->setHeure(0);
            $heuremarche->setPuissance(0);

            if (isset($_POST['noteHeureMarche']))
                $heuremarche->setNote($_POST['noteHeureMarche']);

            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($date);
            $historiqueGroupe->setHeureMarche($heuremarche);
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($heuremarche);
            $em->persist($historiqueGroupe);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle("Ajout d'une heure de marche détaillée de {$groupe->getNumero()} du {$_POST['dateHeureMarche']}" );
            $historiqueGlobal->setLien($this->generateUrl('GroupeHeureMarche_detailHeureMarche', array('id' => $heuremarche->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('GroupeHeureMarche_detailHeureMarche', array('id' => $heuremarche->getId()));
        }

        throw new Exception('Erreur 404 NOT-FOUND');

    }

    /**
     * add heures groupe entities.
     *
     * @Route("/afficher-detail/500{id}/h", name="GroupeHeureMarche_detailHeureMarche")
     *
     *
     */
    public function detailHeureMarcheAction(Request $request, HeureMarche $heureMarche){

        $groupe = $heureMarche->getGroupe();

        return $this->render('@Groupe/GroupeHeureMarche/detailHeureMarche.twig', array(
            'heureMarche' => $heureMarche,
            'groupe' => $groupe,
        ));

    }

    /**
     * add heures groupe entities.
     *
     * @Route("/ajouter/detail/{id}", name="GroupeHeureMarche_ajouterSousHeure", methods={"POST"})
     *
     */
    public function ajouterSousHeureAction(Request $request, HeureMarche $heureMarche){

        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $sousHeure = new SousHeureMarche();
            $sousHeure->setHeureMarche($heureMarche);

            $h1 = \DateTime::createFromFormat('d/m/Y H:i', "{$heureMarche->getDatedebut()->format('d/m/Y')} {$_POST['sousHeureMarche']}");
            $h2 = \DateTime::createFromFormat('d/m/Y H:i', "{$heureMarche->getDatedebut()->format('d/m/Y')} {$_POST['sousHeureArret']}");

            $sousHeure->setHeureDemarrage($h1);
            $sousHeure->setHeureArret($h2);

            $sousHeure->setHeure($_POST['sousHeureHeure']);
            if (isset($_POST['sousHeurePuissance'])){
                $sousHeure->setPuissance($_POST['sousHeurePuissance']);
            }

            if (isset($_POST['sousHeureNote'])){
                $sousHeure->setObservation($_POST['sousHeureNote']);
            }



            $em->persist($sousHeure);
            $em->flush();

            $groupeService = new GroupeService();
            $groupeService->heureMarcheEtPuissanceDetail($em, $heureMarche);

            $em->flush();

            return $this->redirectToRoute('GroupeHeureMarche_detailHeureMarche', array('id' => $heureMarche->getId()));
        }else
            throw $this->createNotFoundException('404 NOT-FOUND');

    }

    /**
     * add heures groupe entities.
     *
     * @Route("/supprimer-sous-heure/500{id}", name="GroupeHeureMarche_supprimerSousHeure")
     *
     */
    public function supprimerSousHeureAction(Request $request, SousHeureMarche $sousHeure){

        $em = $this->getDoctrine()->getManager();

        $heureMarche = $sousHeure->getHeureMarche();

        $em->remove($sousHeure);
        $em->flush();

        $groupeService = new GroupeService();
        $groupeService->heureMarcheEtPuissanceDetail($em, $heureMarche);

        $em->flush();

        return $this->redirectToRoute('GroupeHeureMarche_detailHeureMarche', array('id' => $heureMarche->getId()));
    }

    /**
     * add heures groupe entities.
     *
     * @Route("/supprimer-HM/{id}/delete", name="GroupeHeureMarche_supprimerHeureMarche")
     *
     */
    public function supprimerHeureMarcheAction(Request $request, HeureMarche $heureMarche){

        $em = $this->getDoctrine()->getManager();

        $groupe = $heureMarche->getGroupe();

        $libelle = "Suppression dheure de marche du {$heureMarche->getDatedebut()->format('d/m/Y')} du groupe {$groupe->getNumero()}";
        if ($heureMarche->getDatedebut()->format('d/m/Y') == $heureMarche->getDatefin()->format('d/m/Y')){
            $libelle = "Suppression dheure de marche du {$heureMarche->getDatedebut()->format('d/m/Y')} au {$heureMarche->getDatefin()->format('d/m/Y')} du groupe {$groupe->getNumero()}";
        }
        $url = $this->generateUrl('GroupeHeureMarche_detailHeureGroupe', array('id' =>$groupe->getId()));

        $em->remove($heureMarche);
        $em->flush();

        $groupeService = new GroupeService();
        $groupeService->calculHeure($groupe, $em);

        $historiqueGlobal = new HistoriqueGlobal();
        $historiqueGlobal->setUserHistorique($this->getUser());
        $historiqueGlobal->setLibelle($libelle);
        $historiqueGlobal->setLien($url);

        $em->persist($historiqueGlobal);

        $em->flush();

        return $this->redirectToRoute('GroupeHeureMarche_detailHeureGroupe', array('id' => $groupe->getId()));
    }



}
