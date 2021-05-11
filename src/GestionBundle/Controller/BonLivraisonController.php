<?php

namespace GestionBundle\Controller;

use AppBundle\Services\GestionService;
use AppBundle\Services\ProduitService;
use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\BonExpedition;
use GestionBundle\Entity\BonLivraison;
use GestionBundle\Entity\ligneBonExpedition;
use GestionBundle\Entity\NumDoc;
use ProduitBundle\Entity\HistoriqueProduit;
use ProduitBundle\Entity\Stock_;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UserBundle\Entity\HistoriqueGlobal;
use GestionBundle\Entity\ligneBonLivraison;

/**
 * Sortie controller.
 *
 * @Route("/document/livraison-bon")
 */
class BonLivraisonController extends Controller
{
    const DEMANDE_ENATTENTE = 'En attente de confirmation';
    const DEMANDE_CONFIRME = 'Demande confirmée';
    const DEMANDE_REFUSER = 'Demande refusée';
    const DEMANDE_CLOTURE = 'Demande clôturée';
    const DEMANDE_ENATTENTE_REC = 'En attente de reconfirmation';

    private function recupereNumeroLivraison(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_livraison'
        ));

        if(! $entityNumero){
            $newNum = new NumDoc();
            $newNum->setNumero('001');
            $newNum->setNom('bon_livraison');

            $em->persist($newNum);
            $em->flush();

            $entityNumero = $newNum;
        }

        $numero = 'BL/LP/'.$date->format('Y').'/'.$entityNumero->getNumero();

        return $numero;

    }

    private function nextNumeroLivraison(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_livraison'
        ));

        $numeroPrec = $entityNumero->getNumero();

        $intNextNum = intval($numeroPrec) + 1;
        $nextNum = intval($numeroPrec) + 1;

        if(strlen($intNextNum) == 1){
            $nextNum = '00'.$intNextNum;
        }
        if(strlen($intNextNum) == 2){
            $nextNum = '0'.$intNextNum;
        }

        $numero = $em->getRepository('GestionBundle:NumDoc')
            ->findOneBy(array(
                'nom' => 'bon_livraison'
            ))
        ;
        $numero->setNumero($nextNum);
        $em->persist($numero);

    }

    private function demandeConfirme(BonLivraison $bonLivraison, ObjectManager $em)
    {
        $repositoryStock = $em->getRepository('ProduitBundle:Stock_');

        $serviceProduit = new ProduitService($em);

        $serviceGestion = new GestionService($em);
        if($serviceGestion->testErreurLigneLivraison($bonLivraison) > 0){
            throw new Exception('Erreur! Les lignes de ce document possède des erreurs');

        }

        foreach ($bonLivraison->getLigneBonLivraisons()as $ligne){
            if ($ligne->getProduit()){
                //--------HISTORIQUE DU PRODUIT------------
                $historiqueProduit = new HistoriqueProduit();

                $historiqueProduit->setType('debit');
                $historiqueProduit->setProduit($ligne->getProduit());
                $historiqueProduit->setBonLivraison($bonLivraison);
                $historiqueProduit->setDate($bonLivraison->getDate());
                $historiqueProduit->setQuantite($ligne->getQuantite());

                $em->persist($historiqueProduit);

                //--------------------------------------------

                //-----------------SORTIE DANS LE STOCK-----------------


                if ($bonLivraison->getDepot()){
                    $historiqueProduit->setDepot($bonLivraison->getDepot());
                    $stock = $repositoryStock->findOneBy(array(
                        'produit' => $historiqueProduit->getProduit(),
                        'depot' => $historiqueProduit->getDepot()
                    ));

                    if(!$stock){
                        throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$historiqueProduit->getProduit()->getReference());
                    }
                }

                if ($bonLivraison->getSite()){
                    $historiqueProduit->setSite($bonLivraison->getSite());
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
            }

            //------------------------------------------------

            //---------------------------  ENTRER DANS LE STOCK  -------------------------------

            if($ligne->getProduit()){
                $historiqueProduit1 = new HistoriqueProduit();

                $historiqueProduit1->setType('credit');
                $historiqueProduit1->setProduit($ligne->getProduit());
                $historiqueProduit1->setBonLivraison($bonLivraison);
                $historiqueProduit1->setDate($bonLivraison->getDate());
                $historiqueProduit1->setQuantite($ligne->getQuantite());

                //DESTINATION
                $historiqueProduit1->setSite($bonLivraison->getSiteDestination());

                $em->persist($historiqueProduit1);

//            MIS A JOUR DU STOCK
                $stockDestination = null;

                $stockDestination = $repositoryStock->findOneBy(array(
                    'produit' => $historiqueProduit1->getProduit(),
                    'site' => $bonLivraison->getSiteDestination()
                ));

                if (!$stockDestination){
                    $stockDestination = new Stock_();
                    $stockDestination->setQuantite(0);
                    $stockDestination->setProduit($historiqueProduit1->getProduit());
                    $stockDestination->setSite($bonLivraison->getSiteDestination());
                }

                $quantite1 = $stockDestination->getQuantite() + $historiqueProduit1->getQuantite();
                $stockDestination->setQuantite($quantite1);

                $em->persist($stockDestination);
            }



            //-----------------------------/// ENTRER DANS LE STOCK ///-----------------------------
        }

        $em->flush();

        //--------UPDATE STOCK TOTAL-----------------
        foreach ($bonLivraison->getLigneBonLivraisons() as $ligne){
            if($ligne->getProduit()){
                $produit = $ligne->getProduit();
                $serviceProduit->updateStockTotal($produit);
            }

        }

        $bonLivraison->setEtat(self::DEMANDE_CONFIRME);

        $em->persist($bonLivraison);
        $em->flush();
    }

    /**
     * INDEX
     *
     * @Route("/", name="bonLivraison_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repositorySorties = $em->getRepository('GestionBundle:BonLivraison');

        $bonLivraisons = $repositorySorties->findBy(array());


        return $this->render('@Gestion/BonLivraison/index.html.twig', array(
            'bonLivraisons' => $bonLivraisons,
            'bonLivraison' => new BonLivraison(),



        ));

    }

    /**
     * NEW
     *
     * @Route("/nouveau", name="bonLivraison_new")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $repositoryGroupe = $em->getRepository('GroupeBundle:Groupe');
        $repositorySite = $em->getRepository('GroupeBundle:Site');

        $depots = $repositoryDepot->findBy(array('etat'=>true));
        $groupes = $repositoryGroupe->findAll();
        $sites = $repositorySite->findBy(
            array(),
            array('emplacement' => "asc")
        );

        if ($request->getMethod() == 'POST'){
            $bonLivraison = new BonLivraison();

            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $bonLivraison->setDate($date);
            if($_POST['groupe'])
            {
                $groupe = $repositoryGroupe->findOneBy(array('id'=>$_POST['groupe']));
                $bonLivraison->setGroupe($groupe);

                if(!$groupe)
                    throw new Exception('Vérifier le groupe');

                $bonLivraison->setSiteDestination($groupe->getSite());
            }

            $bonLivraison->setDate($date);
            $bonLivraison->setNumero($_POST['numero']);
            $bonLivraison->setUserCreer($this->getUser());

            if (isset($_POST['motif']))
                $bonLivraison->setMotif($_POST['motif']);

            $bonLivraison->setDestination($_POST['destination']);

            // ------------------ AGENT ------------------

            $bonLivraison->setAgent($_POST['agent']);
            $bonLivraison->setPosteAgent($_POST['posteAgent']);
            $bonLivraison->setContactAgent($_POST['contactAgent']);

            if (isset($_POST['agent2']))
                $bonLivraison->setAgent2($_POST['agent2']);


            if (isset($_POST['posteAgent2']))
                $bonLivraison->setPosteAgent2($_POST['posteAgent2']);


            if (isset($_POST['contactAgent2']))
                $bonLivraison->setContactAgent2($_POST['contactAgent2']);


            // ------------------///// AGENT /////------------------



            // ------------------- EMPLACEMEMNT ---------------------

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $bonLivraison->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $bonLivraison->setDepot($depot);
            }

            // ------------------- ////// EMPLACEMEMNT ////// ---------------------

            //NEXT NUMERO
            $this->nextNumeroLivraison($em);

            $em->persist($bonLivraison);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Bon de livraison n° '.$bonLivraison->getNumero().' créé');
            $historiqueGlobal->setLien($this->generateUrl('bonLivraison_show', array('id' => $bonLivraison->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonLivraison_show', array('id' => $bonLivraison->getId()));
        }


        return $this->render('@Gestion/BonLivraison/new.html.twig', array(
            'numero' => $this->recupereNumeroLivraison($em),
            'depots' => $depots,
            'groupes'=> $groupes,
            'sites' => $sites,

        ));

        
    }

    /**
     * NEW
     *
     * @Route("/afficher/{id}/", name="bonLivraison_show")
     */
    public function showAction(BonLivraison $bonLivraison){

        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();

        return $this->render('@Gestion/BonLivraison/show.html.twig', array(
            'bonLivraison' => $bonLivraison,
            'produits' => $produits,
        ));
    }

    /**
     * AJOUTER LIGNE
     *
     * @Route("/ajouter-ligne{id}/1", name="bonLivraison_ajouterLigne")
     */
    public function ajouterLigneAction(Request $request, BonLivraison $bonLivraison)
    {
        if($_POST['quantite'] <= 0 )
            throw new Exception('Erreur! La quantité doit être supérieur à zéro(0)');

        $em = $this->getDoctrine()->getManager();


        if($request->getMethod() == 'POST') {
            $repositoryStock = $em->getRepository(Stock_::class);

            $lignes = $bonLivraison->getLignebonLivraisons();

            $idProduit = $_POST['produit'];

            //--------- --- TEST TEST TEST ---------------------

            $error = null;

            foreach ($lignes as $ligne){
                if ($ligne->getProduit()->getId() == $idProduit){
                    $error = "Erreur! Ce produit est déjà dans cette bon delivraison";
                    throw new Exception($error);
                }

            }

            //----------//// TEST TEST TEST ////------------------

            $ligne = new ligneBonLivraison();
            $ligne->setbonLivraison($bonLivraison);
            $ligne->setDesignation($_POST['designation']);
            $ligne->setQuantite($_POST['quantite']);
            $ligne->setObservation($_POST['observation']);

            $repositoryProduit = $em->getRepository('ProduitBundle:Produit');
            $produit = $repositoryProduit->findOneBy(array('id' => $idProduit));


            // ------------------- TEST DU STOCK ---------------------
            $stock = null;
            if ($bonLivraison->getDepot()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'depot' => $bonLivraison->getDepot()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$produit->getReference());
                }
            }

            if ($bonLivraison->getSite()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'site' => $bonLivraison->getSite()
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

            return $this->redirectToRoute('bonLivraison_show', array('id'=>$bonLivraison->getId()));

        }

        throw new Exception('Erreur! 404 Not-Found');
    }

    /**
     * SUPPRIMER LIGNE
     *
     * @Route("/supprimer/ligne{id}/1", name="bonLivraison_supprimerLigne")
     */
    public function supprimerLigneAction(ligneBonLivraison $ligneBonLivraison)
    {
        $em = $this->getDoctrine()->getManager();
        $bonLivraison= $ligneBonLivraison->getBonLivraison();

        $em->remove($ligneBonLivraison);
        $em->flush();

        return $this->redirectToRoute('bonLivraison_show', array('id'=>$bonLivraison->getId()));

    }

    /**
     * ENREGISTRER
     *
     * @Route("/s/save/{id}", name="bonLivraison_enregistrer")
     */
    public function enregistrerAction(BonLivraison $bonLivraison)
    {
        $em = $this->getDoctrine()->getManager();
        if(! $bonLivraison->getModifiable())
            throw new Exception('Erreur! Ce document est déjà enregistré');

        $serviceGestion = new GestionService($em);
        if($serviceGestion->testErreurLigneLivraison($bonLivraison) > 0){
            throw new Exception('Erreur! Les lignes de ce document possède des erreurs');
        }
        
        if($bonLivraison->getEtat() == self::DEMANDE_REFUSER){
            $bonLivraison->setEtat(self::DEMANDE_ENATTENTE_REC);
        }else{
            $bonLivraison->setEtat(self::DEMANDE_ENATTENTE);
        }

        $bonLivraison->setModifiable(false);
        $em->persist($bonLivraison);

        $em->flush();

        return $this->redirectToRoute('bonLivraison_show', array('id'=>$bonLivraison->getId()));
        
    }

    /**
     * CONFIRMER
     *
     * @Route("/confirmer/{id}/500", name="bonLivraison_confirmer")
     */
    public function confirmerAction(BonLivraison $bonLivraison)
    {

        $em = $this->getDoctrine()->getManager();
        if($bonLivraison->getEtat() == self::DEMANDE_CONFIRME){
            return $this->redirectToRoute('bonLivraison_show', array('id' => $bonLivraison->getId()));
        }

        //SCRIPT RECONFIRMATION
        if($bonLivraison->getUserRefuser()){
            $bonLivraison->setUserRefuser(null);
            $bonLivraison->setModifiable(false);

            $bonLivraison->setEtat(self::DEMANDE_ENATTENTE);
        }

        $bonLivraison->addUserConfirme($this->getUser());

//        TEST NOMBRE CONFIRMATION
        $nombreConfirmation = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'livraison'
            ))->getNombre()
        ;

        if ($nombreConfirmation == count($bonLivraison->getUserConfirmes())){
            $this->demandeConfirme($bonLivraison,$em);
        }

        $em->persist($bonLivraison);
        $em->flush();

        // ------------------- HISTORIQUE GLOBAL ---------------------

        $historiqueGlobal = new HistoriqueGlobal();
        $historiqueGlobal->setUserHistorique($this->getUser());
        $historiqueGlobal->setLibelle('Confirmation bon de livraisonN°'.$bonLivraison->getNumero().' ');
        $historiqueGlobal->setLien($this->generateUrl('bonLivraison_show', array('id' => $bonLivraison->getId())));

        $em->persist($historiqueGlobal);
        $em->flush();

        // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

        return $this->redirectToRoute('bonLivraison_show', array('id'=>$bonLivraison->getId()));

    }

    /**
     * REFUSER
     *
     * @Route("/refuser/500{id}/rf", name="bonLivraison_refuser")
     */
    public function refuserAction(Request $request, BonLivraison $bonLivraison)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($bonLivraison->getUserConfirmes() as $userConfirme){
                $bonLivraison->removeUserConfirme($userConfirme);
            }

            $bonLivraison->setUserRefuser($this->getUser());
            $bonLivraison->setModifiable(true);
            $bonLivraison->setTexte($_POST['text']);

            $bonLivraison->setEtat(self::DEMANDE_REFUSER);

            $em->persist($bonLivraison);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Bon de livraison n° '.$bonLivraison->getNumero().' refusé');
            $historiqueGlobal->setLien($this->generateUrl('bonLivraison_show', array('id' => $bonLivraison->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonLivraison_show', array('id'=>$bonLivraison->getId()));
        }

        throw new Exception('Erreur 404 NOT-FOUND');
    }

    /**
     * REFUSER
     *
     * @Route("/{id}/cloturer/demande", name="bonLivraison_cloturer")
     */
    public function cloturerAction(Request $request, BonLivraison $bonLivraison)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($bonLivraison->getUserConfirmes() as $userConfirme){
                $bonLivraison->removeUserConfirme($userConfirme);
            }

            $bonLivraison->setUserRefuser($this->getUser());
            $bonLivraison->setModifiable(false);
            $bonLivraison->setTexte($_POST['text']);

            $bonLivraison->setEtat(self::DEMANDE_CLOTURE);

            $em->persist($bonLivraison);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Sortie en stock n° '.$bonLivraison->getNumero().' clôturé');
            $historiqueGlobal->setLien($this->generateUrl('sortie_afficher', array('id' => $bonLivraison->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonLivraison_show', array('id'=>$bonLivraison->getId()));


        }

        throw new Exception('Erreur 404 NOT-FOUND');


    }

    /**
     * REFUSER
     *
     * @Route("/modifier_bl/{id}/demande", name="bonLivraison_edit")
     */
    public function modifierAction(Request $request, BonLivraison $bonLivraison)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $repositoryGroupe = $em->getRepository('GroupeBundle:Groupe');
        $repositorySite = $em->getRepository('GroupeBundle:Site');

        $depots = $repositoryDepot->findBy(array('etat'=>true));
        $groupes = $repositoryGroupe->findAll();
        $sites = $repositorySite->findBy(
            array(),
            array('emplacement' => "asc")
        );

        if ($request->getMethod() == 'POST'){
            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $bonLivraison->setDate($date);
            if($_POST['groupe'])
            {
                $groupe = $repositoryGroupe->findOneBy(array('id'=>$_POST['groupe']));
                $bonLivraison->setGroupe($groupe);

                if(!$groupe)
                    throw new Exception('Vérifier le groupe');

                $bonLivraison->setSiteDestination($groupe->getSite());
            }
            $bonLivraison->setDate($date);
            $bonLivraison->setUserCreer($this->getUser());

            if (isset($_POST['motif']))
                $bonLivraison->setMotif($_POST['motif']);

            $bonLivraison->setDestination($_POST['destination']);

            // ------------------ AGENT ------------------

            $bonLivraison->setAgent($_POST['agent']);
            $bonLivraison->setPosteAgent($_POST['posteAgent']);
            $bonLivraison->setContactAgent($_POST['contactAgent']);

            if (isset($_POST['agent2']))
                $bonLivraison->setAgent2($_POST['agent2']);


            if (isset($_POST['posteAgent2']))
                $bonLivraison->setPosteAgent2($_POST['posteAgent2']);


            if (isset($_POST['contactAgent2']))
                $bonLivraison->setContactAgent2($_POST['contactAgent2']);


            // ------------------///// AGENT /////------------------

            // ------------------- EMPLACEMEMNT ---------------------

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $bonLivraison->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $bonLivraison->setDepot($depot);
            }

            // ------------------- ////// EMPLACEMEMNT ////// ---------------------

            $em->persist($bonLivraison);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Modification du Bon de livraison n° '.$bonLivraison->getNumero());
            $historiqueGlobal->setLien($this->generateUrl('bonLivraison_show', array('id' => $bonLivraison->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonLivraison_show', array('id' => $bonLivraison->getId()));
        }


        return $this->render('@Gestion/BonLivraison/edit.html.twig', array(
            'numero' => $bonLivraison->getNumero(),
            'depots' => $depots,
            'groupes'=> $groupes,
            'sites' => $sites,
            'bonLivraison' => $bonLivraison
        ));
    }

    /**
     * IMPRIMER
     *
     * @Route("/imp{id}/imprimer", name="bonLivraison_imprimer")
     */
    public function imprimerAction(BonLivraison $bonLivraison)
    {
        return $this->render('@Gestion/BonLivraison/imprimer.html.twig', array(
            'bonLivraison' => $bonLivraison
        ));
    }

    /**
     * REFUSER
     *
     * @Route("/{id}/date/200/arrivée", name="bonLivraison_dateArrivee")
     */
    public function ajouterDateArriveeAction(Request $request, BonLivraison $bonLivraison)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){
            $dateArrivee = \DateTime::createFromFormat('d/m/Y',$_POST['dateArrivee']);
            $bonLivraison->setDateArrivee($dateArrivee);

            $em->persist($bonLivraison);
            $em->flush();

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Attribution du date d\'arrivée '.$bonLivraison->getNumero().'');
            $historiqueGlobal->setLien($this->generateUrl('bonLivraison_show', array('id' => $bonLivraison->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            return $this->redirectToRoute('bonLivraison_show', array('id' => $bonLivraison->getId()));
        }

        throw new Exception('404 NOT-FOUND');
    }
}
