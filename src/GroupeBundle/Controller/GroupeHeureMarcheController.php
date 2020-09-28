<?php

namespace GroupeBundle\Controller;

use AppBundle\Services\ProduitService;
use Doctrine\Common\Persistence\ObjectManager;
use GroupeBundle\Entity\Appoint;
use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HeureMarche;
use GroupeBundle\Entity\SousHeureMarche;
use GroupeBundle\Entity\Vidange;
use ProduitBundle\Entity\HistoriqueProduit;
use ProduitBundle\Entity\Produit;
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

    private function appointHeureMarche(HeureMarche $heureMarche, ObjectManager $em, $entreHuile, Produit $huile){
        $groupe = $heureMarche->getGroupe();

        $appoint = new Appoint();
        $appoint->setGroupe($groupe);
        $appoint->setDate($heureMarche->getDatedebut());
        $appoint->setHuileUtilise($entreHuile);

        // ------------------- HUILE UTILISE ---------------------
        $qttUtilise = $entreHuile;
        if ($qttUtilise < 0)
            throw new Exception('Erreur! Valeur de huile utilisé négatif');

        if(isset($_POST['appoint_chkHuile'])){
            // ------------------- STOCK HUILE ---------------------
            $stockHuile = 0;

            $repositoryStock = $em->getRepository('ProduitBundle:Stock_');
            $stcHuile = $repositoryStock->findOneBy(array(
                'produit' => $huile,
                'site' =>$groupe->getSite()
            ));

            if($stcHuile){
                $stockHuile = $stcHuile->getQuantite();
            }

            if ($stockHuile < $qttUtilise){
                throw new Exception('Erreur! Stock d\'huile insufisante');
            }

            $huileRestant = $stockHuile - $qttUtilise;
            $stcHuile->setQuantite($huileRestant);
            $em->persist($stcHuile);
            // ------------------- ////// STOCK HUILE ////// ---------------------


            //--------HISTORIQUE DU PRODUIT------------
            $historiqueProduit = new HistoriqueProduit();

            $historiqueProduit->setType('debit');
            $historiqueProduit->setProduit($huile);
            $historiqueProduit->setAppoint($appoint);
            $historiqueProduit->setDate($appoint->getDate());
            $historiqueProduit->setQuantite($qttUtilise);
            $historiqueProduit->setSite($heureMarche->getGroupe()->getSite());


            $em->persist($historiqueProduit);
            // ------------------- ////// HUILE UTILISE ////// ---------------------
        }


        $historiqueGroupe = new HistoriqueGroupe();
        $historiqueGroupe->setAppoint($appoint);
        $historiqueGroupe->setDate($appoint->getDate());
        $historiqueGroupe->setGroupe($heureMarche->getGroupe());

        $em->persist($appoint);
        $em->persist($historiqueGroupe);

        return $appoint;
    }

    private function vidangeHeureMarche(HeureMarche $heureMarche, ObjectManager $em, $entreHuile, Produit $huile){
        $groupe = $heureMarche->getGroupe();

        $vidange = new Vidange();
        $vidange->setGroupe($groupe);
        $vidange->setDate($heureMarche->getDatedebut());
        $vidange->setType($_POST['vidange_typeVidange']);
        $vidange->setHeureMarche($_POST['vidange_heureMarche']);

        $qttUtilise = $entreHuile;
        $vidange->setHuileUtilise($qttUtilise);


        // ------------------- HUILE UTILISE ---------------------

        if (isset($_POST['vidange_huileUtilise']) and isset($_POST['vidange_chkHuile'])){

            if ($qttUtilise < 0)
                throw new Exception('Erreur! Valeur de huile utilisé négatif');

            // ------------------- STOCK HUILE ---------------------

            $stockHuile = 0;

            if (!$huile){
                throw new Exception('Erreur! Huile par défaut non-défini.');
            }

            $repositoryStock = $em->getRepository('ProduitBundle:Stock_');
            $stcHuile = $repositoryStock->findOneBy(array(
                'produit' => $huile,
                'site' => $groupe->getSite()
            ));

            if ($stcHuile){
                $stockHuile = $stcHuile->getQuantite();
            }

            if ($stockHuile < $qttUtilise){
                throw new Exception('Erreur! Stock d\'huile insufisante');
            }

            $huileRestant = $stockHuile - $qttUtilise;
            $stcHuile->setQuantite($huileRestant);
            $em->persist($stcHuile);

            // ------------------- ////// STOCK HUILE ////// ---------------------

            //--------HISTORIQUE DU PRODUIT------------
            $historiqueProduit = new HistoriqueProduit();

            $historiqueProduit->setType('debit');
            $historiqueProduit->setProduit($huile);
            $historiqueProduit->setVidange($vidange);
            $historiqueProduit->setDate($vidange->getDate());
            $historiqueProduit->setQuantite($qttUtilise);
            $historiqueProduit->setSite($groupe->getSite());

            $em->persist($historiqueProduit);
        }
        // ------------------- ////// HUILE UTILISE ////// ---------------------

        $historiqueGroupe = new HistoriqueGroupe();
        $historiqueGroupe->setVidange($vidange);
        $historiqueGroupe->setDate($vidange->getDate());
        $historiqueGroupe->setGroupe($groupe);

        $em->persist($vidange);
        $em->persist($historiqueGroupe);

        return $vidange;
    }

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
    public function addHeureByGroupeAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        // ------------------- STOCK D'HUILE ---------------------
        $stockHuile = 0;
        $huile = $em->getRepository('ProduitBundle:Produit')->findOneBy(array(
            'huileParDefaut' => true,
            'siHuile' => true
        ));
        $repositoryStock = $em->getRepository('ProduitBundle:Stock_');
        $stcHuile = $repositoryStock->findOneBy(array(
            'produit' => $huile,
            'site' => $groupe->getSite()
        ));

        if ($stcHuile){
            $stockHuile = $stcHuile->getQuantite();
        }

        // ------------------- ////// STOCK D'HUILE ////// ---------------------


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


            //---------------------------  HEURE ET MINUTE MARCHE  -------------------------------

            $heuremarche->setHeure(0);

            $hTotal = $_POST['heure'];
            $hMarche = (int)$hTotal;
            $restehTotal = $hTotal-$hMarche;

            $mTotal = (int)$_POST['minute'];
            $mTotal = $mTotal + ($hMarche * 60) + ($restehTotal * 60);

            if ($mTotal < 0) {
                return new Exception('Vérifier l\'heure de marche');
            }

            if ($mTotal == 0) {
                $heuremarche->setHeure(0);
                $heuremarche->setMinute(0);
            } else{
                $valueHm = array(
                    'heure' => (int)($mTotal / 60),
                    'minute' => fmod($mTotal, 60)
                );

                $heuremarche->setHeure($valueHm['heure']);
                $heuremarche->setMinute($valueHm['minute']);
            }


            //-----------------------------/// HEURE ET MINUTE MARCHE ///-----------------------------

            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($date);
            $historiqueGroupe->setHeureMarche($heuremarche);
            $historiqueGroupe->setGroupe($groupe);

            if(isset($_POST['note']))
                $heuremarche->setNote($_POST['note']);

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


            // ------------------ TEST HUILE UTILISE ------------------

            $totalHuileUtilise = 0;
            $appointHuileUtilise = 0;
            $vidangeHuileUtilise = 0;

            if(isset($_POST['appoint_huileUtilise']) ){
                if($_POST['appoint_huileUtilise'] > 0)
                    $appointHuileUtilise = $_POST['appoint_huileUtilise'];
            }

            if(isset($_POST['vidange_huileUtilise']) ){
                if($_POST['vidange_huileUtilise'] > 0)
                    $vidangeHuileUtilise = $_POST['vidange_huileUtilise'];
            }

            $totalHuileUtilise = $appointHuileUtilise + $vidangeHuileUtilise;

            if (! isset($_POST['appoint_chkHuile']))
                $totalHuileUtilise -= $appointHuileUtilise;

            if (! isset($_POST['vidange_chkHuile']))
                $totalHuileUtilise -= $vidangeHuileUtilise;

            if($totalHuileUtilise > $stockHuile and (isset($_POST['appoint_chkHuile']) or isset($_POST['vidange_chkHuile'])))
                return new Exception('Stock d\'huile insuffisante sur site' );

            // ------------------///// TEST HUILE UTILISE /////------------------


           // ------------------ APPOINT D'HUILE ------------------

            if($appointHuileUtilise > 0){
                $appoint = $this->appointHeureMarche($heuremarche, $em, $appointHuileUtilise, $huile);
                $heuremarche->setAppoint($appoint);
            }

           // ------------------///// APPOINT D'HUILE /////------------------

            // ------------------ VIDANGE HUILE ------------------

            if ($_POST['vidange_typeVidange'] != '0'){
                $vidange = $this->vidangeHeureMarche($heuremarche, $em, $vidangeHuileUtilise, $huile);
                $heuremarche->setVidange($vidange);
            }

            // ------------------///// VIDANGE HUILE /////------------------



            $em->persist($heuremarche);
            $em->persist($historiqueGroupe);
            $em->flush();



            // ------------------ MIS A JOUR HEURE DE MARCHE GROUPE ------------------
            $groupeService= new GroupeService();
            $groupeService->calculHeure($groupe,$em);
            // ------------------///// MIS A JOUR HEURE DE MARCHE GROUPE /////------------------


            // ------------------ MIS A JOUR STOCK HUILE ------------------
            if ($huile){
                $serviceProduit = new ProduitService($em);
                $serviceProduit->updateStockTotal($huile);
            }
            // ------------------///// MIS A JOUR STOCK HUILE /////------------------

            $em->flush();

            return $this->redirectToRoute('GroupeHeureMarche_detailHeureGroupe', array('id' => $groupe->getId()));
        }
        return $this->render('@Groupe/heureMarche/addHeureByGroupe.html.twig',array(
            'groupe'=>$groupe,
            'stockHuile' => $stockHuile
        ));
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
