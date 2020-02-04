<?php

namespace GestionBundle\Controller;


use AppBundle\Services\ProduitService;
use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\Entre;
use GestionBundle\Entity\ligneEntre;
use GestionBundle\Entity\NumDoc;
use ProduitBundle\Entity\HistoriqueProduit;
use ProduitBundle\Entity\Stock_;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Services\GestionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use UserBundle\Entity\HistoriqueGlobal;


/**
 * Entrée controller.
 *
 * @Route("/document/bon")
 */
class EntreController extends Controller
{
    
    const DEMANDE_ENATTENTE = 'En attente de confirmation';
    const DEMANDE_CONFIRME = 'Demande confirmée';
    const DEMANDE_REFUSER = 'Demande refusée';
    const DEMANDE_CLOTURE = 'Demande clôturée';
    const DEMANDE_ENATTENTE_REC = 'En attente de reconfirmation';
    const ETAT_ENREGISTRER = 'En attente de reconfirmation';

    private function recupereNumeroEntre(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_entrée'
        ));

        if(! $entityNumero){
            $newNum = new NumDoc();
            $newNum->setNumero('001');
            $newNum->setNom('bon_entrée');

            $em->persist($newNum);
            $em->flush();

            $entityNumero = $newNum;
        }

        $numero = 'ENT-'.$entityNumero->getNumero().'/'.$date->format('Y');

        return $numero;

    }

    private function nextNumero(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_entrée'
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
                'nom' => 'bon_entrée'
            ))
        ;
        $numero->setNumero($nextNum);
        $em->persist($numero);

    }

    /**
     * INDEX
     *
     * @Route("/liste", name="entre_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entres = $em->getRepository('GestionBundle:Entre')
            ->findAll()
        ;

        return $this->render('@Gestion/Entre/index.html.twig', array(
            'entres' => $entres,

        ));

    }
    /**
     * test.
     *
     * @Route("/test", name="test")
     *
     */
    public function testAction()
    {
        $data = array('12','24','23');
        $json= json_encode($data);
        return new Response($json);
    }

    /**
     * nouveau entity.
     *
     * @Route("/nouveau", name="entre_creer")
     */
    public function creerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true));
        $fournisseurs =  $em->getRepository('FournisseurBundle:Fournisseur')->findAll();
        if($request->getMethod() == 'POST'){
            $entre = new Entre();

            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $entre->setDate($date);
            $entre->setNumero($_POST['numero']);
            $entre->setUserCreer($this->getUser());

            if (isset($_POST['fournisseur']) and $_POST['fournisseur'])
            {
                $fournisseur =  $em->getRepository('FournisseurBundle:Fournisseur')->findOneBy(array('id'=>$_POST['fournisseur']));
                $entre->setFournisseur($fournisseur);
            }


            if (isset($_POST['motif']))
                $entre->setMotif($_POST['motif']);

            $depot = $repositoryDepot->findOneBy(array(
                'id' => $_POST['depot']
            ));
            $entre->setDepot($depot);

            //NEXT NUMERO
            $this->nextNumero($em);

            $em->persist($entre);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Entré en stock n° '.$entre->getNumero().' créer');
            $historiqueGlobal->setLien($this->generateUrl('entre_affcher', array('id' => $entre->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));
            
            
        }

        return $this->render('@Gestion/Entre/new.html.twig', array(
            'numero' => $this->recupereNumeroEntre($em),
            'depots' => $depots,
            'fournisseurs'=>$fournisseurs,

        ));

    }
    /**
     * modifier entity.
     *
     * @Route("/modifier-entre/DF231{id}A35", name="entre_edit")
     */
    public function modifierEntreAction(Request $request,Entre $entre)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true));
        $fournisseurs =  $em->getRepository('FournisseurBundle:Fournisseur')->findAll();

        if($request->getMethod() == 'POST'){


            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
           $entre->setDate($date);

            if ($entre->getEtat()=='En attente de confirmation' or $entre->getEtat()=='Demande confirmée'){
                $em->flush();

                return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));
            }

            if (isset($_POST['fournisseur']) and $_POST['fournisseur'])
            {
                $fournisseur =  $em->getRepository('FournisseurBundle:Fournisseur')->findOneBy(array('id'=>$_POST['fournisseur']));
                $entre->setFournisseur($fournisseur);
            }
            else
            {
                $entre->setFournisseur(null);
            }

            if (isset($_POST['motif']))
                $entre->setMotif($_POST['motif']);



            if (isset($_POST['depot']) and $_POST['depot'])
            {
                $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
                $depot = $repositoryDepot->findOneBy(array(
                    'id' => $_POST['depot']
                ));
                $entre->setDepot($depot);
            }



            $em->persist($entre);
            $em->flush();

            return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));


        }

        return $this->render('@Gestion/Entre/edit.html.twig', array(
            'numero' => $this->recupereNumeroEntre($em),
            'depots' => $depots,
            'entre'=>$entre,
            'fournisseurs'=>$fournisseurs,

        ));

    }

    /**
     * nouveau entity.
     *
     * @Route("/afficher/R85{id}L55", name="entre_affcher")
     */
    public function afficherAction(Request $request, Entre $entre){

        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();

        return $this->render('@Gestion/Entre/show.html.twig', array(
            'entre' => $entre,
            'produits' => $produits,
        ));
    }

    /**
     * nouveau entity.
     *
     * @Route("/ajouter-ligne/500/R89{id}2L55", name="entre_ajouterLigne")
     */
    public function ajouterLigneAction(Request $request, Entre $entre)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){
            //--------- --- TEST TEST TEST ---------------------
            $lignes = $entre->getLigneEntres();

            $idProduit = $_POST['produit'];

            $error = null;
            if ($_POST['quantite'] <= 0){
                $error = "Erreur! Quantité zéro";
            }

            foreach ($lignes as $ligne){
                if ($ligne->getProduit()->getId() == $idProduit)
                    $error = "Ce produit est déjà dans cette bon d'entrée";
            }

            if($error){
                throw new Exception($error);
            }

            //----------//// TEST TEST TEST ////------------------

            $ligne = new ligneEntre();
            $ligne->setDesignation($_POST['designation']);
            $ligne->setQuantite($_POST['quantite']);
            $ligne->setEntre($entre);

            if (isset($_POST['prixAchat']))
                $ligne->setPrixAchat($_POST['prixAchat']);

            if (isset($_POST['utilite']))
                $ligne->setPrixAchat($_POST['utilite']);

            $repositoryProduit = $em->getRepository('ProduitBundle:Produit');
            $produit = $repositoryProduit->findOneBy(array('id' => $idProduit));

            $ligne->setProduit($produit);

            $em->persist($ligne);
            $em->flush();

            return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));
        }

        throw new Exception('Erreur! 404 Not-Found');

    }

    /**
     * nouveau entity.
     *
     * @Route("/ligne/modifier/R89{id}2L55", name="entre_modifierLigne")
     */
    public function modifierLigneAction(Request $request, ligneEntre $ligneEntre){

        if(! $ligneEntre->getEntre()->getModifiable())
            throw new Exception('Erreur: Ce document n\'est plus modifiable');

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST'){
            $ligneEntre->setDesignation($_POST['designation']);
            $ligneEntre->setQuantite($_POST['quantite']);

            if (isset($_POST['prixAchat']))
                $ligneEntre->setPrixAchat($_POST['prixAchat']);

            if (isset($_POST['utilite']))
                $ligneEntre->setPrixAchat($_POST['utilite']);

            $em->persist($ligneEntre);
            $em->flush();

            return $this->redirectToRoute('entre_affcher', array('id' => $ligneEntre->getEntre()->getId()));
        }


        return $this->render('@Gestion/Entre/editLigneEntre.html.twig', array(
            'ligneEntre' => $ligneEntre,
        ));

    }

    /**
     * nouveau entity.
     *
     * @Route("/500{id}2L55/enregistrer-entre", name="entre_enregistrer")
     */
    public function enregistrerAction(Request $request, Entre $entre){
        $em = $this->getDoctrine()->getManager();
        if(! $entre->getModifiable())
            throw new Exception('Erreur! Ce document est déjà enregistré');


//        MODIFICATION DU ENTRE
        $entre->setEtat(self::DEMANDE_ENATTENTE);
        $entre->setModifiable(false);
        $em->persist($entre);

        $em->flush();

        return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));
    }
    /**
     * nouveau entity.
     *
     * @Route("confirmer/500{id}2L55/e", name="entre_confirme")
     */
    public function confirmerAction(Request $request, Entre $entre)
    {
        $em = $this->getDoctrine()->getManager();
        if($entre->getEtat() == self::DEMANDE_CONFIRME){
            return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));
        }

        //SCRIPT RECONFIRMATION
        if($entre->getUserRefuser()){
            $entre->setUserRefuser(null);
            $entre->setModifiable(false);

            $entre->setEtat(self::DEMANDE_ENATTENTE);
        }

        $entre->addUserConfirme($this->getUser());

//        TEST NOMBRE CONFIRMATION
        $nombreConfirmation = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'entre'
            ))->getNombre()
        ;

        if ($nombreConfirmation == count($entre->getUserConfirmes())){
            $this->demandeConfirme($entre, $em);
        }

        $em->persist($entre);
        $em->flush();

        return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));
    }

    private function demandeConfirme(Entre $entre, ObjectManager $em){
        //        //Initialisation
        $repositoryStock = $em->getRepository('ProduitBundle:Stock_');


        $serviceProduit = new ProduitService($em);

        foreach ($entre->getLigneEntres() as $ligneEntre){

            //--------HISTORIQUE DU PRODUIT------------
            $historiqueProduit = new HistoriqueProduit();

            $historiqueProduit->setType('credit');
            $historiqueProduit->setProduit($ligneEntre->getProduit());
            $historiqueProduit->setEntre($entre);
            $historiqueProduit->setDepot($entre->getDepot());
            $historiqueProduit->setDate($entre->getDate());
            $historiqueProduit->setQuantite($ligneEntre->getQuantite());

            $em->persist($historiqueProduit);

            //--------------------------------------------

            //-----------------ENTREE DANS LE STOCK-----------------

            $stock = $repositoryStock->findOneBy(array(
                'produit' => $historiqueProduit->getProduit(),
                'depot' => $historiqueProduit->getDepot()
            ));

            if(!$stock){
                $stock = new Stock_();
                $stock->setDepot($historiqueProduit->getDepot());
                $stock->setProduit($historiqueProduit->getProduit());
                $stock->setQuantite(0);
            }

            $quantite = $stock->getQuantite() + $historiqueProduit->getQuantite();
            $stock->setQuantite($quantite);

            $em->persist($stock);
            $em->flush();
            //------------------------------------------------

            //--------UPDATE STOCK TOTAL-----------------
            $produit = $historiqueProduit->getProduit();
            $serviceProduit->updateStockTotal($produit);
            $em->flush();

        }

//        MODIFICATION DU ENTRE
        $entre->setEtat(self::DEMANDE_CONFIRME);
        $entre->setModifiable(false);
        $em->persist($entre);

        $em->flush();

    }
    /**
     * nouveau entity.
     *
     * @Route("refuser/{id}2L55/e", name="entre_refuser")
     */
    public function refuserAction(Request $request, Entre $entre)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($entre->getUserConfirmes() as $userConfirme){
                $entre->removeUserConfirme($userConfirme);
            }

            $entre->setUserRefuser($this->getUser());
            $entre->setModifiable(true);
            $entre->setTexte($_POST['textRefuser']);

            $entre->setEtat(self::DEMANDE_REFUSER);

            $em->persist($entre);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Entré en stock n° '.$entre->getNumero().' refusé');
            $historiqueGlobal->setLien($this->generateUrl('entre_affcher', array('id' => $entre->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));

        }

        return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));

    }
    /**
     * nouveau entity.
     *
     * @Route("/cloturer/{id}2L55/e", name="entre_cloturer")
     */
    public function cloturerAction(Request $request, Entre $entre)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($entre->getUserConfirmes() as $userConfirme){
                $entre->removeUserConfirme($userConfirme);
            }

            $entre->setUserRefuser($this->getUser());
            $entre->setModifiable(false);
            $entre->setTexte($_POST['textCloturer']);

            $entre->setEtat(self::DEMANDE_CLOTURE);

            $em->persist($entre);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Entré en stock n° '.$entre->getNumero().' clôturé');
            $historiqueGlobal->setLien($this->generateUrl('entre_affcher', array('id' => $entre->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------


            return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));

        }

        return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));

    }


    /**
     * nouveau entity.
     *
     * @Route("/ligne/edit/R89{id}2L55/supprimer", name="entre_supprimerLigne")
     */
    public function supprimerLigneAction(Request $request, ligneEntre $ligneEntre){
        $em = $this->getDoctrine()->getManager();

        $entre = $ligneEntre->getEntre();

        $em->remove($ligneEntre);
        $em->flush();

        return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));
    }


    /**
     * nouveau entity.
     *
     * @Route("/imprimer/{id}", name="entre_imprimer")
     */
    public function imprimerAction(Request $request, Entre $entre){

        return $this->render('@Gestion/Entre/imprimer.html.twig', array(
            'entre' => $entre,
        ));
    }

}
