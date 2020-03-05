<?php

namespace GestionBundle\Controller;

use AppBundle\Services\GestionService;
use AppBundle\Services\ProduitService;
use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\ligneSortie;
use GestionBundle\Entity\NumDoc;
use GestionBundle\Entity\Sortie;
use ProduitBundle\Entity\HistoriqueProduit;
use ProduitBundle\Entity\Stock_;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use GroupeBundle\Entity\Groupe;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Entrée controller.
 *
 * @Route("/document/bon-sortie/s")
 */
class SortieController extends Controller
{

    const DEMANDE_ENATTENTE = 'En attente de confirmation';
    const DEMANDE_CONFIRME = 'Demande confirmée';
    const DEMANDE_REFUSER = 'Demande refusée';
    const DEMANDE_CLOTURE = 'Demande clôturée';
    const DEMANDE_ENATTENTE_REC = 'En attente de reconfirmation';

    private function recupereNumeroSortie(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_sortie'
        ));

        if(! $entityNumero){
            $newNum = new NumDoc();
            $newNum->setNumero('001');
            $newNum->setNom('bon_sortie');

            $em->persist($newNum);
            $em->flush();

            $entityNumero = $newNum;
        }

        $numero = 'SOT-'.$entityNumero->getNumero().'/'.$date->format('Y');

        return $numero;

    }

    private function nextNumero(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_sortie'
        ));

        $numeroPrec = $entityNumero->getNumero();

        $intNextNum = intval($numeroPrec) + 1;
        $nextNum = $intNextNum + 1;

        if(strlen($intNextNum) == 1){
            $nextNum = '00'.$intNextNum;
        }
        if(strlen($intNextNum) == 2){
            $nextNum = '0'.$intNextNum;
        }

        $numero = $em->getRepository('GestionBundle:NumDoc')
            ->findOneBy(array(
                'nom' => 'bon_sortie'
            ))
        ;
        $numero->setNumero($nextNum);
        $em->persist($numero);

    }

    private function demandeConfirme(Sortie $sortie, ObjectManager $em){
        //        //Initialisation
        $repositoryStock = $em->getRepository('ProduitBundle:Stock_');

        $serviceProduit = new ProduitService($em);

        $serviceGestion = new GestionService($em);
        if($serviceGestion->testErreurLigneSortie($sortie) > 0){
            throw new Exception('Erreur! Les lignes de ce document possède des erreurs');

        }

        foreach ($sortie->getLigneSorties() as $ligneSortie){

            //--------HISTORIQUE DU PRODUIT------------
            $historiqueProduit = new HistoriqueProduit();

            $historiqueProduit->setType('debit');
            $historiqueProduit->setProduit($ligneSortie->getProduit());
            $historiqueProduit->setSortie($sortie);
            $historiqueProduit->setDate($sortie->getDate());
            $historiqueProduit->setQuantite($ligneSortie->getQuantite());

            $em->persist($historiqueProduit);

            //--------------------------------------------

            //-----------------SORTIE DANS LE STOCK-----------------


            if ($sortie->getDepot()){
                $historiqueProduit->setDepot($sortie->getDepot());
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $historiqueProduit->getProduit(),
                    'depot' => $historiqueProduit->getDepot()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$historiqueProduit->getProduit()->getReference());
                }
            }

            if ($sortie->getSite()){
                $historiqueProduit->setSite($sortie->getSite());
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $historiqueProduit->getProduit(),
                    'site' => $historiqueProduit->getSite()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le site: '.$historiqueProduit->getProduit()->getReference());
                }
            }

            $quantite = $stock->getQuantite() - $historiqueProduit->getQuantite();

            if($quantite < 0){
                throw new Exception('Erreur! La quantité est supérieur par rapport au stock: '.$historiqueProduit->getProduit()->getReference());
            }

            $stock->setQuantite($quantite);

            $em->persist($stock);

            //------------------------------------------------
        }

        $em->flush();

        //--------UPDATE STOCK TOTAL-----------------
        foreach ($sortie->getLigneSorties() as $ligneSortie){
            $produit = $ligneSortie->getProduit();
            $serviceProduit->updateStockTotal($produit);
        }


        $sortie->setEtat(self::DEMANDE_CONFIRME);

        $em->persist($sortie);
        $em->flush();

    }

    /**
     * nouveau entity.
     *
     * @Route("/nouveau", name="sortie_creer")
     */
    public function creerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true));
        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

        $repositorySite = $em->getRepository('GroupeBundle:Site');

        $sites = $repositorySite->findBy(
            array(),
            array('emplacement' => "asc")
        );
        
        if($request->getMethod() == 'POST'){
            $sortie = new Sortie();
            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $sortie->setDate($date);
            if($_POST['groupe'])
            {
                $groupe = $em->getRepository('GroupeBundle:Groupe')->findOneBy(array('id'=>$_POST['groupe']));
                $sortie->setGroupe($groupe);
            }
            $sortie->setDate($date);
            $sortie->setNumero($_POST['numero']);
            $sortie->setUserCreer($this->getUser());

            if (isset($_POST['motif']))
                $sortie->setMotif($_POST['motif']);

            if (isset($_POST['destination']))
                $sortie->setDestination($_POST['destination']);

            // ------------------- EMPLACEMEMNT ---------------------

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $sortie->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $sortie->setDepot($depot);
            }

            // ------------------- ////// EMPLACEMEMNT ////// ---------------------

            //NEXT NUMERO
            $this->nextNumero($em);

            $em->persist($sortie);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Sortie en stock n° '.$sortie->getNumero().' créé');
            $historiqueGlobal->setLien($this->generateUrl('sortie_afficher', array('id' => $sortie->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
        }

        return $this->render('@Gestion/Sortie/new.html.twig', array(
            'numero' => $this->recupereNumeroSortie($em),
            'depots' => $depots,
            'groupes'=> $groupes,
            'sites' => $sites,

        ));

    }


    /**
     * edit entity.
     *
     * @Route("/modifier-sortie/AC2D{id}4F", name="sortie_edit")
     */
    public function editAction(Request $request, Sortie $sortie)
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true));
        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();

        $repositorySite = $em->getRepository('GroupeBundle:Site');

        $sites = $repositorySite->findBy(
            array(),
            array('emplacement' => "asc")
        );


        if($request->getMethod() == 'POST'){

            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $sortie->setDate($date);

            if ($sortie->getEtat()=='En attente de confirmation' or $sortie->getEtat()=='Demande confirmé'){
                $em->flush();

                return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
            }

            if($_POST['groupe'])
            {
                $groupe = $em->getRepository('GroupeBundle:Groupe')->findOneBy(array('id'=>$_POST['groupe']));
                $sortie->setGroupe($groupe);
            }
            else
            {
                $sortie->setGroupe(null);
            }

            // ------------------- EMPLACEMEMNT ---------------------

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $sortie->setSite($site);
                $sortie->setDepot(null);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $sortie->setDepot($depot);
                $sortie->setSite(null);
            }

            // ------------------- ////// EMPLACEMEMNT ////// ---------------------

            if (isset($_POST['motif']))
                $sortie->setMotif($_POST['motif']);

            if (isset($_POST['destination']))
                $sortie->setDestination($_POST['destination']);

            $em->flush();

            return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
        }

        return $this->render('@Gestion/Sortie/edit.html.twig', array(
            'sortie' => $sortie,
            'depots' => $depots,
            'groupes'=> $groupes,
            'sites' => $sites,

        ));

    }


    /**
     * nouveau entity.
     *
     * @Route("/AF4{id}462", name="sortie_afficher")
     */
    public function afficherAction(Request $request, Sortie $sortie){
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();

        return $this->render('@Gestion/Sortie/show.html.twig', array(
            'sortie' => $sortie,
            'produits' => $produits,
        ));
    }

    /**
     * INDEX
     *
     * @Route("/liste", name="sortie_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repositorySorties = $em->getRepository('GestionBundle:Sortie');

        $sorties = $repositorySorties->findAll();


        return $this->render('@Gestion/Sortie/index.html.twig', array(
            'sorties' => $sorties,

        ));

    }

    /**
     * nouveau entity.
     *
     * @Route("/ajouter-ligne/R89{id}2L55", name="sortie_ajouterLigne")
     */
    public function ajouterLigneAction(Request $request, Sortie $sortie)
    {
        if($_POST['quantite'] <= 0 )
            throw new Exception('Erreur! La quantité doit être supérieur à zéro(0)');

        $em = $this->getDoctrine()->getManager();


        if($request->getMethod() == 'POST'){
            $repositoryStock = $em->getRepository(Stock_::class);


            $lignes = $sortie->getLigneSorties();

            $idProduit = $_POST['produit'];

            //--------- --- TEST TEST TEST ---------------------

            $error = null;
            if ($_POST['quantite'] <= 0){
                $error = "Erreur! Quantité zéro";
            }

            foreach ($lignes as $ligne){
                if ($ligne->getProduit()->getId() == $idProduit)
                    $error = "Erreur! Ce produit est déjà dans cette bon d'entrée";
            }

            if($error)
                throw new Exception($error);


            //----------//// TEST TEST TEST ////------------------

            $ligne = new ligneSortie();
            $ligne->setDesignation($_POST['designation']);
            $ligne->setQuantite($_POST['quantite']);
            $ligne->setSortie($sortie);

            if(isset($_POST['utilite']))
                $ligne->setUtilite($_POST['utilite']);

            $repositoryProduit = $em->getRepository('ProduitBundle:Produit');
            $produit = $repositoryProduit->findOneBy(array('id' => $idProduit));



            // ------------------- TEST DU STOCK ---------------------
            $stock = null;
            if ($sortie->getDepot()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'depot' => $sortie->getDepot()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$produit->getReference());
                }
            }

            if ($sortie->getSite()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'site' => $sortie->getSite()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le site: '.$produit->getReference());
                }
            }

            $quantiteEnStock = $stock->getQuantite();

            if($quantiteEnStock < 0){
                throw new Exception('Erreur! La quantité est supérieur par rapport au stock: '.$produit->getReference());
            }

            if($ligne->getQuantite() > $quantiteEnStock)
                throw new Exception('Erreur! La quantité est supérieur que le stock dans le stock');

            // ------------------- ////// TEST DU STOCK ////// ---------------------

            $ligne->setProduit($produit);

            $em->persist($ligne);
            $em->flush();

            return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
        }

        throw new Exception('Erreur! 404 Not-Found');

    }

    /**
     * Supprimer entity.
     *
     * @Route("/ligne/R89{id}2L5/supprimer", name="sortie_supprimerLigne")
     */
    public function supprimerLigneAction(Request $request, ligneSortie $ligneSortie){
        $em = $this->getDoctrine()->getManager();

        $sortie = $ligneSortie->getSortie();

        $em->remove($ligneSortie);
        $em->flush();

        return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
    }


    /**
     * nouveau entity.
     *
     * @Route("/ligne/modifier/R89{id}2L55", name="sortie_modifierLigne")
     */
    public function modifierLigneAction(Request $request, ligneSortie $ligneSortie){

        if(! $ligneSortie->getSortie()->getModifiable())
            throw new Exception('Erreur: Ce document n\'est plus modifiable');

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST'){
            $ligneSortie->setDesignation($_POST['designation']);
            $ligneSortie->setQuantite($_POST['quantite']);

            if(isset($_POST['utilite']))
                $ligneSortie->setUtilite($_POST['utilite']);

            $em->persist($ligneSortie);
            $em->flush();

            return $this->redirectToRoute('sortie_afficher', array('id' => $ligneSortie->getSortie()->getId()));
        }

        return $this->render('@Gestion/Sortie/editLigneSortie.html.twig', array(
            'ligneSortie' => $ligneSortie,
        ));

    }


    /**
     * nouveau entity.
     *
     * @Route("/500{id}2L55/enregistrer-sortie", name="sortie_enregistrer")
     */
    public function enregistrerAction(Request $request, Sortie $sortie){
        $em = $this->getDoctrine()->getManager();
        if(! $sortie->getModifiable())
            throw new Exception('Erreur! Ce document est déjà enregistré');

        $serviceGestion = new GestionService($em);
        if($serviceGestion->testErreurLigneSortie($sortie) > 0){
            throw new Exception('Erreur! Les lignes de ce document possède des erreurs');

        }

//        MODIFICATION DU ENTRE
        $sortie->setEtat(self::DEMANDE_ENATTENTE);
        $sortie->setModifiable(false);
        $em->persist($sortie);

        $em->flush();

        return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
    }


    /**
     * nouveau entity.
     *
     * @Route("confirmer/500{id}2L55/s", name="sortie_confirme")
     */
    public function confirmerAction(Request $request, Sortie $sortie)
    {
        $em = $this->getDoctrine()->getManager();
        if($sortie->getEtat() == self::DEMANDE_CONFIRME){
            return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
        }

        //SCRIPT RECONFIRMATION
        if($sortie->getUserRefuser()){
            $sortie->setUserRefuser(null);
            $sortie->setModifiable(false);

            $sortie->setEtat(self::DEMANDE_ENATTENTE);
        }

        $sortie->addUserConfirme($this->getUser());

//        TEST NOMBRE CONFIRMATION
        $nombreConfirmation = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'sortie'
            ))->getNombre()
            ;

        if ($nombreConfirmation == count($sortie->getUserConfirmes())){
            $this->demandeConfirme($sortie, $em);
        }

        $em->persist($sortie);
        $em->flush();

        // ------------------- HISTORIQUE GLOBAL ---------------------

        $historiqueGlobal = new HistoriqueGlobal();
        $historiqueGlobal->setUserHistorique($this->getUser());
        $historiqueGlobal->setLibelle('Sortie en stock n° '.$sortie->getNumero().' confirmé');
        $historiqueGlobal->setLien($this->generateUrl('sortie_afficher', array('id' => $sortie->getId())));

        $em->persist($historiqueGlobal);
        $em->flush();

        // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------


        return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));
    }

    /**
     * nouveau entity.
     *
     * @Route("refuser/{id}2L55/s", name="sortie_refuser")
     */
    public function refuserAction(Request $request, Sortie $sortie)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($sortie->getUserConfirmes() as $userConfirme){
                $sortie->removeUserConfirme($userConfirme);
            }

            $sortie->setUserRefuser($this->getUser());
            $sortie->setModifiable(true);
            $sortie->setTexte($_POST['text']);

            $sortie->setEtat(self::DEMANDE_REFUSER);

            $em->persist($sortie);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Sortie en stock n° '.$sortie->getNumero().' refusé');
            $historiqueGlobal->setLien($this->generateUrl('sortie_afficher', array('id' => $sortie->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));

        }

        return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));

    }

    /**
     * nouveau entity.
     *
     * @Route("/cloturer/{id}2L55/s", name="sortie_cloturer")
     */
    public function cloturerAction(Request $request, Sortie $sortie)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($sortie->getUserConfirmes() as $userConfirme){
                $sortie->removeUserConfirme($userConfirme);
            }

            $sortie->setUserRefuser($this->getUser());
            $sortie->setModifiable(false);
            $sortie->setTexte($_POST['text']);

            $sortie->setEtat(self::DEMANDE_CLOTURE);

            $em->persist($sortie);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Sortie en stock n° '.$sortie->getNumero().' clôturé');
            $historiqueGlobal->setLien($this->generateUrl('sortie_afficher', array('id' => $sortie->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));

        }

        return $this->redirectToRoute('sortie_afficher', array('id' => $sortie->getId()));

    }

    /**
     * nouveau entity.
     *
     * @Route("/__/imp/{id}", name="sortie_imprimer")
     */
    public function imprimerAction(Request $request, Sortie $sortie){
        return $this->render('@Gestion/Sortie/imprimer.html.twig', array(
            'sortie' => $sortie,
        ));
    }
}
