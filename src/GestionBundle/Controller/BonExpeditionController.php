<?php

namespace GestionBundle\Controller;

use AppBundle\Services\GestionService;
use AppBundle\Services\ProduitService;
use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\BonExpedition;
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

/**
 * Sortie controller.
 *
 * @Route("/document/bon/expedition")
 */
class BonExpeditionController extends Controller
{
    const DEMANDE_ENATTENTE = 'En attente de confirmation';
    const DEMANDE_CONFIRME = 'Demande confirmée';
    const DEMANDE_REFUSER = 'Demande refusée';
    const DEMANDE_CLOTURE = 'Demande clôturée';
    const DEMANDE_ENATTENTE_REC = 'En attente de reconfirmation';

    private function recupereNumeroExpedition(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_expedition'
        ));

        if(! $entityNumero){
            $newNum = new NumDoc();
            $newNum->setNumero('001');
            $newNum->setNom('bon_expedition');

            $em->persist($newNum);
            $em->flush();

            $entityNumero = $newNum;
        }

        $numero = 'BE/LP/'.$date->format('Y').'/'.$entityNumero->getNumero();

        return $numero;

    }

    private function nextNumero(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_expedition'
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
                'nom' => 'bon_expedition'
            ))
        ;
        $numero->setNumero($nextNum);
        $em->persist($numero);

    }

    private function demandeConfirme(BonExpedition $bonExpedition, ObjectManager $em)
    {
        $repositoryStock = $em->getRepository('ProduitBundle:Stock_');

        $serviceProduit = new ProduitService($em);

        $serviceGestion = new GestionService($em);
        if($serviceGestion->testErreurLigneExpedition($bonExpedition) > 0){
            throw new Exception('Erreur! Les lignes de ce document possède des erreurs');

        }

        foreach ($bonExpedition->getLigneBonExpeditions() as $ligne){

            //--------HISTORIQUE DU PRODUIT------------
            $historiqueProduit = new HistoriqueProduit();

            $historiqueProduit->setType('debit');
            $historiqueProduit->setProduit($ligne->getProduit());
            $historiqueProduit->setBonExpedition($bonExpedition);
            $historiqueProduit->setDate($bonExpedition->getDate());
            $historiqueProduit->setQuantite($ligne->getQuantite());

            $em->persist($historiqueProduit);

            //--------------------------------------------

            //-----------------SORTIE DANS LE STOCK-----------------


            if ($bonExpedition->getDepot()){
                $historiqueProduit->setDepot($bonExpedition->getDepot());
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $historiqueProduit->getProduit(),
                    'depot' => $historiqueProduit->getDepot()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$historiqueProduit->getProduit()->getReference());
                }
            }

            if ($bonExpedition->getSite()){
                $historiqueProduit->setSite($bonExpedition->getSite());
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
        foreach ($bonExpedition->getLigneBonExpeditions() as $ligne){
            $produit = $ligne->getProduit();
            $serviceProduit->updateStockTotal($produit);
        }

        $bonExpedition->setEtat(self::DEMANDE_CONFIRME);

        $em->persist($bonExpedition);
        $em->flush();


    }

    /**
     * INDEX
     *
     * @Route("/", name="bonExpedition_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repositorySorties = $em->getRepository('GestionBundle:BonExpedition');

        $bonExpedition = $repositorySorties->findBy(array());


        return $this->render('@Gestion/BonExpedition/index.html.twig', array(
            'bonExpeditions' => $bonExpedition,

        ));

    }

    /**
     * NEW
     *
     * @Route("/nouveau", name="bonExpedition_new")
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
            $bonExpedition = new BonExpedition();

            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $bonExpedition->setDate($date);
            if($_POST['groupe'])
            {
                $groupe = $repositoryGroupe->findOneBy(array('id'=>$_POST['groupe']));
                $bonExpedition->setGroupe($groupe);
            }
            $bonExpedition->setDate($date);
            $bonExpedition->setNumero($_POST['numero']);
            $bonExpedition->setUserCreer($this->getUser());

            if (isset($_POST['motif']))
                $bonExpedition->setMotif($_POST['motif']);


            $bonExpedition->setDestination($_POST['destination']);

            $bonExpedition->setAgent($_POST['agent']);

            if (isset($_POST['contactAgent']))
                $bonExpedition->setContactAgent($_POST['contactAgent']);

            if(isset($_POST['transporteur']))
                $bonExpedition->setTransporteur($_POST['transporteur']);

            if (isset($_POST['numeroTransporteur']))
                $bonExpedition->setContactTransporteur($_POST['numeroTransporteur']);

            if (isset($_POST['vehiculeTransporteur']))
                $bonExpedition->setVehiculeTransporteur($_POST['vehiculeTransporteur']);

            if(isset($_POST['coutTransport']))
                $bonExpedition->setCoutTransport($_POST['coutTransport']);

            // ------------------- EMPLACEMEMNT ---------------------

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $bonExpedition->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $bonExpedition->setDepot($depot);
            }

            // ------------------- ////// EMPLACEMEMNT ////// ---------------------

            //NEXT NUMERO
            $this->nextNumero($em);

            $em->persist($bonExpedition);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Bon d\'expédition n° '.$bonExpedition->getNumero().' créé');
            $historiqueGlobal->setLien($this->generateUrl('bonExpedition_show', array('id' => $bonExpedition->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonExpedition_show', array('id' => $bonExpedition->getId()));
        }


        return $this->render('@Gestion/BonExpedition/new.html.twig', array(
            'numero' => $this->recupereNumeroExpedition($em),
            'depots' => $depots,
            'groupes'=> $groupes,
            'sites' => $sites,

        ));



    }

    /**
     * NEW
     *
     * @Route("/afficher/{id}/", name="bonExpedition_show")
     */
    public function showAction(BonExpedition $bonExpedition){

        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();

        return $this->render('@Gestion/BonExpedition/show.html.twig', array(
            'bonExpedition' => $bonExpedition,
            'produits' => $produits,
        ));
    }

    /**
     * AJOUTER LIGNE
     *
     * @Route("/ajouter-ligne{id}/1", name="bonExpedition_ajouterLigne")
     */
    public function ajouterLigneAction(Request $request, BonExpedition $bonExpedition)
    {
        if($_POST['quantite'] <= 0 )
            throw new Exception('Erreur! La quantité doit être supérieur à zéro(0)');

        $em = $this->getDoctrine()->getManager();


        if($request->getMethod() == 'POST') {
            $repositoryStock = $em->getRepository(Stock_::class);

            $lignes = $bonExpedition->getLigneBonExpeditions();

            $idProduit = $_POST['produit'];

            //--------- --- TEST TEST TEST ---------------------

            $error = null;

            foreach ($lignes as $ligne){
                if ($ligne->getProduit()->getId() == $idProduit){
                    $error = "Erreur! Ce produit est déjà dans cette bon d'entrée";
                    throw new Exception($error);
                }

            }

            //----------//// TEST TEST TEST ////------------------

            $ligne = new ligneBonExpedition();
            $ligne->setBonExpedition($bonExpedition);
            $ligne->setDesignation($_POST['designation']);
            $ligne->setQuantite($_POST['quantite']);
            $ligne->setObservation($_POST['observation']);

            $repositoryProduit = $em->getRepository('ProduitBundle:Produit');
            $produit = $repositoryProduit->findOneBy(array('id' => $idProduit));


            // ------------------- TEST DU STOCK ---------------------
            $stock = null;
            if ($bonExpedition->getDepot()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'depot' => $bonExpedition->getDepot()
                ));

                if(!$stock){
                    throw new Exception('Erreur! La quantité est supérieur par rapport au stock dans le dépôt: '.$produit->getReference());
                }
            }

            if ($bonExpedition->getSite()){
                $stock = $repositoryStock->findOneBy(array(
                    'produit' => $produit,
                    'site' => $bonExpedition->getSite()
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

            return $this->redirectToRoute('bonExpedition_show', array('id'=>$bonExpedition->getId()));

        }

        throw new Exception('Erreur! 404 Not-Found');
    }

    /**
     * SUPPRIMER LIGNE
     *
     * @Route("/supprimer/ligne{id}/1", name="bonExpedition_supprimerLigne")
     */
    public function supprimerLigneAction(ligneBonExpedition $ligneBonExpedition)
    {
        $em = $this->getDoctrine()->getManager();
        $bonExpedition = $ligneBonExpedition->getBonExpedition();

        $em->remove($ligneBonExpedition);
        $em->flush();

        return $this->redirectToRoute('bonExpedition_show', array('id'=>$bonExpedition->getId()));

    }

    /**
     * ENREGISTRER
     *
     * @Route("/s/save/{id}", name="bonExpedition_enregistrer")
     */
    public function enregistrerAction(BonExpedition $bonExpedition)
    {
        $em = $this->getDoctrine()->getManager();
        if(! $bonExpedition->getModifiable())
            throw new Exception('Erreur! Ce document est déjà enregistré');

        $serviceGestion = new GestionService($em);
        if($serviceGestion->testErreurLigneExpedition($bonExpedition) > 0){
            throw new Exception('Erreur! Les lignes de ce document possède des erreurs');

        }

//        MODIFICATION DU ENTRE
        $bonExpedition->setEtat(self::DEMANDE_ENATTENTE);
        $bonExpedition->setModifiable(false);
        $em->persist($bonExpedition);

        $em->flush();

        return $this->redirectToRoute('bonExpedition_show', array('id'=>$bonExpedition->getId()));
        
    }

    /**
     * CONFIRMER
     *
     * @Route("/confirmer/{id}/500", name="bonExpedition_confirmer")
     */
    public function confirmerAction(BonExpedition $bonExpedition)
    {
        $em = $this->getDoctrine()->getManager();
        if($bonExpedition->getEtat() == self::DEMANDE_CONFIRME){
            return $this->redirectToRoute('bonExpedition_show', array('id' => $bonExpedition->getId()));
        }

        //SCRIPT RECONFIRMATION
        if($bonExpedition->getUserRefuser()){
            $bonExpedition->setUserRefuser(null);
            $bonExpedition->setModifiable(false);

            $bonExpedition->setEtat(self::DEMANDE_ENATTENTE);
        }

        $bonExpedition->addUserConfirme($this->getUser());

//        TEST NOMBRE CONFIRMATION
        $nombreConfirmation = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'expedition'
            ))->getNombre()
        ;

        if ($nombreConfirmation == count($bonExpedition->getUserConfirmes())){
            $this->demandeConfirme($bonExpedition, $em);
        }

        $em->persist($bonExpedition);
        $em->flush();

        // ------------------- HISTORIQUE GLOBAL ---------------------

        $historiqueGlobal = new HistoriqueGlobal();
        $historiqueGlobal->setUserHistorique($this->getUser());
        $historiqueGlobal->setLibelle('Confirmation bon d\'expédition N°'.$bonExpedition->getNumero().' ');
        $historiqueGlobal->setLien($this->generateUrl('bonExpedition_show', array('id' => $bonExpedition->getId())));

        $em->persist($historiqueGlobal);
        $em->flush();

        // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

        return $this->redirectToRoute('bonExpedition_show', array('id'=>$bonExpedition->getId()));

    }

    /**
     * REFUSER
     *
     * @Route("/refuser/500{id}/rf", name="bonExpedition_refuser")
     */
    public function refuserAction(Request $request, BonExpedition $bonExpedition)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($bonExpedition->getUserConfirmes() as $userConfirme){
                $bonExpedition->removeUserConfirme($userConfirme);
            }

            $bonExpedition->setUserRefuser($this->getUser());
            $bonExpedition->setModifiable(true);
            $bonExpedition->setTexte($_POST['text']);

            $bonExpedition->setEtat(self::DEMANDE_REFUSER);

            $em->persist($bonExpedition);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Bon d\'expedition n° '.$bonExpedition->getNumero().' refusé');
            $historiqueGlobal->setLien($this->generateUrl('bonExpedition_show', array('id' => $bonExpedition->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonExpedition_show', array('id'=>$bonExpedition->getId()));
        }

        throw new Exception('Erreur 404 NOT-FOUND');
    }

    /**
     * REFUSER
     *
     * @Route("/{id}/cloturer/demande", name="bonExpedition_cloturer")
     */
    public function cloturerAction(Request $request, BonExpedition $bonExpedition)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($bonExpedition->getUserConfirmes() as $userConfirme){
                $bonExpedition->removeUserConfirme($userConfirme);
            }

            $bonExpedition->setUserRefuser($this->getUser());
            $bonExpedition->setModifiable(false);
            $bonExpedition->setTexte($_POST['text']);

            $bonExpedition->setEtat(self::DEMANDE_CLOTURE);

            $em->persist($bonExpedition);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Sortie en stock n° '.$bonExpedition->getNumero().' clôturé');
            $historiqueGlobal->setLien($this->generateUrl('sortie_afficher', array('id' => $bonExpedition->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonExpedition_show', array('id'=>$bonExpedition->getId()));


        }

        throw new Exception('Erreur 404 NOT-FOUND');


    }

    /**
     * REFUSER
     *
     * @Route("/modifier/{id}/demande", name="bonExpedition_edit")
     */
    public function modifierAction(Request $request, BonExpedition $bonExpedition)
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
            $bonExpedition->setDate($date);
            if($_POST['groupe'])
            {
                $groupe = $repositoryGroupe->findOneBy(array('id'=>$_POST['groupe']));
                $bonExpedition->setGroupe($groupe);
            }
            $bonExpedition->setDate($date);
            $bonExpedition->setUserCreer($this->getUser());

            if (isset($_POST['motif']))
                $bonExpedition->setMotif($_POST['motif']);


            $bonExpedition->setDestination($_POST['destination']);

            $bonExpedition->setAgent($_POST['agent']);

            if (isset($_POST['contactAgent']))
                $bonExpedition->setContactAgent($_POST['contactAgent']);

            if(isset($_POST['transporteur']))
                $bonExpedition->setTransporteur($_POST['transporteur']);

            if (isset($_POST['numeroTransporteur']))
                $bonExpedition->setContactTransporteur($_POST['numeroTransporteur']);

            if (isset($_POST['vehiculeTransporteur']))
                $bonExpedition->setVehiculeTransporteur($_POST['vehiculeTransporteur']);

            if(isset($_POST['coutTransport']))
                $bonExpedition->setCoutTransport($_POST['coutTransport']);

            // ------------------- EMPLACEMEMNT ---------------------

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $bonExpedition->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $bonExpedition->setDepot($depot);
            }

            // ------------------- ////// EMPLACEMEMNT ////// ---------------------

            //NEXT NUMERO
            $this->nextNumero($em);

            $em->persist($bonExpedition);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Modification du Bon d\'expédition n° '.$bonExpedition->getNumero());
            $historiqueGlobal->setLien($this->generateUrl('bonExpedition_show', array('id' => $bonExpedition->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('bonExpedition_show', array('id' => $bonExpedition->getId()));
        }


        return $this->render('@Gestion/BonExpedition/edit.html.twig', array(
            'numero' => $bonExpedition->getNumero(),
            'depots' => $depots,
            'groupes'=> $groupes,
            'sites' => $sites,
            'bonExpedition' => $bonExpedition
        ));
    }

    /**
     * IMPRIMER
     *
     * @Route("/imp{id}/imprimer", name="bonExpedition_imprimer")
     */
    public function imprimerAction(BonExpedition $bonExpedition)
    {
        return $this->render('@Gestion/BonExpedition/imprimer.html.twig', array(
            'bonExpedition' => $bonExpedition
        ));
    }
}
