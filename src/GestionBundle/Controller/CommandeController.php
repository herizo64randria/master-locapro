<?php

namespace GestionBundle\Controller;

use AppBundle\Services\ProduitService;
use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\Commande;
use GestionBundle\Entity\Entre;
use GestionBundle\Entity\ligneCommande;
use GestionBundle\Entity\ligneEntre;
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
* Entrée controller.
 *
 * @Route("/document/bon")
*/
class CommandeController extends Controller
{
    const DEMANDE_ENATTENTE = 'En attente de confirmation';
    const DEMANDE_CONFIRME = 'Demande confirmée';
    const DEMANDE_REFUSER = 'Demande refusée';
    const DEMANDE_CLOTURE = 'Demande clôturée';
    const DEMANDE_ENATTENTE_REC = 'En attente de reconfirmation';
    const ETAT_ENREGISTRER = 'En attente de reconfirmation';

    private function recupereNumeroCommande(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_commande'
        ));

        if(! $entityNumero){
            $newNum = new NumDoc();
            $newNum->setNumero('001');
            $newNum->setNom('bon_commande');

            $em->persist($newNum);
            $em->flush();

            $entityNumero = $newNum;
        }

        $numero = 'CMD-'.$entityNumero->getNumero().'/'.$date->format('Y');

        return $numero;

    }
    private function nextNumero(ObjectManager $em){
//   $em = $this->getDoctrine()->getManager();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_commande'
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
                'nom' => 'bon_commande'
            ))
        ;
        $numero->setNumero($nextNum);
        $em->persist($numero);

    }
    /**
     * INDEX
     *
     * @Route("/liste-commande", name="commande_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes   = $em->getRepository('GestionBundle:Commande')->findAll();

        return $this->render('@Gestion/BonCommande/index.html.twig', array(
            'commandes' => $commandes,

        ));

    }
    /**
     * nouveau entity.
     *
     * @Route("/nouveau-bon-commande", name="commande_creer")
     */
    public function newAction(Request $request)
    {
         $em=$this->getDoctrine()->getManager();
         $numero=$this->recupereNumeroCommande($em);
        $fournisseurs =  $em->getRepository('FournisseurBundle:Fournisseur')->findAll();


        if ($request->getMethod()=='POST'){
             $commande = new Commande();
             $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
             $commande->setDate($date);
             $commande->setNumero($_POST['numero']);
             if(isset($_POST['motif']))
                $commande->setMotif($_POST['motif']);
             $commande->setUserCreer($this->getUser());
            if (isset($_POST['fournisseur']) and $_POST['fournisseur'])
            {
                $fournisseur =  $em->getRepository('FournisseurBundle:Fournisseur')->findOneBy(array('id'=>$_POST['fournisseur']));
                $commande->setFournisseur($fournisseur);
            }
             $this->nextNumero($em);
             $em->persist($commande);
             $em->flush();

             // ------------------- HISTORIQUE GLOBAL ---------------------

             $historiqueGlobal = new HistoriqueGlobal();
             $historiqueGlobal->setUserHistorique($this->getUser());
             $historiqueGlobal->setLibelle('Bon commande n° '.$commande->getNumero().' créer');
             //$historiqueGlobal->setLien($this->generateUrl('commande_afficher', array('id' => $commande->getId())));

             $em->persist($historiqueGlobal);
             $em->flush();
            return $this->redirectToRoute('commande_index');
             // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

         }
        return $this->render('@Gestion/BonCommande/new.html.twig',array('numero'=>$numero,'fournisseurs'=>$fournisseurs));
    }
    /**
     * nouveau entity.
     *
     * @Route("/afficher/R85{id}L715", name="commande_afficher")
     */
    public function afficherAction(Request $request, Commande $commande){

        $em = $this->getDoctrine()->getManager();
        $entre=$em->getRepository('GestionBundle:Entre')->findOneBy(array('commande'=>$commande));
        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();

        return $this->render('@Gestion/BonCommande/show.html.twig', array(
            'commande' => $commande,
            'produits' => $produits,
            'entre'=>$entre,
        ));
    }
    /**
     * nouveau entity.
     *
     * @Route("/ajouter-ligne-commande/500/R89{id}2L55", name="commande_ajouterLigne")
     */
    public function ajouterLigneAction(Request $request, Commande $commande)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){
            //--------- --- TEST TEST TEST ---------------------
            $lignes = $commande->getLigneCommandes();

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

            $ligne = new ligneCommande();
            $ligne->setDesignation($_POST['designation']);
            $ligne->setQuantite($_POST['quantite']);
            $ligne->setCommande($commande);

            if (isset($_POST['prixAchat']))
                $ligne->setPrix($_POST['prixAchat']);

            if (isset($_POST['utilite']))
                $ligne->setUtilite($_POST['utilite']);

            $repositoryProduit = $em->getRepository('ProduitBundle:Produit');
            $produit = $repositoryProduit->findOneBy(array('id' => $idProduit));

            $ligne->setProduit($produit);

            $em->persist($ligne);
            $em->flush();

            return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));
        }

        throw new Exception('Erreur! 404 Not-Found');

    }
    /**
     * nouveau entity.
     *
     * @Route("/ligne/edit/R89{id}2L55/supprimer", name="commande_supprimerLigne")
     */
    public function supprimerLigneAction(Request $request, ligneCommande $ligneCommande){
        $em = $this->getDoctrine()->getManager();

        $commande = $ligneCommande->getCommande();

        $em->remove($ligneCommande);
        $em->flush();

        return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));
    }
    /**
     * nouveau entity.
     *
     * @Route("/500{id}2L55/enregistrer-commande", name="commande_enregistrer")
     */
    public function enregistrerAction(Request $request, Commande $commande){
        $em = $this->getDoctrine()->getManager();
        if(! $commande->getModifiable())
            throw new Exception('Erreur! Ce document est déjà enregistré');


//        MODIFICATION DU commande
        $commande->setEtat(self::DEMANDE_ENATTENTE);
        $commande->setModifiable(false);
        $em->persist($commande);

        $em->flush();

        return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));
    }
    /**
     * modifier entity.
     *
     * @Route("/modifier-commande/DF231{id}A35", name="commande_edit")
     */
    public function modifierEntreAction(Request $request,Commande $commande)
    {
        $em = $this->getDoctrine()->getManager();


        $fournisseurs =  $em->getRepository('FournisseurBundle:Fournisseur')->findAll();



        if($request->getMethod() == 'POST'){


            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $commande->setDate($date);

            if ($commande->getEtat()=='En attente de confirmation' or $commande->getEtat()=='Demande confirmée'){
                $em->flush();

                return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));
            }

            if (isset($_POST['fournisseur']) and $_POST['fournisseur'])
            {
                $fournisseur =  $em->getRepository('FournisseurBundle:Fournisseur')->findOneBy(array('id'=>$_POST['fournisseur']));
                $commande->setFournisseur($fournisseur);
            }
            else
            {
                $commande->setFournisseur(null);
            }

            if (isset($_POST['motif'])){
                $commande->setMotif($_POST['motif']);

            }




            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));
        }

        return $this->render('@Gestion/BonCommande/edit.html.twig', array(
            'numero' => $this->recupereNumeroCommande($em),
            'commande'=>$commande,
            'fournisseurs'=>$fournisseurs,
        ));

    }
    /**
     * nouveau entity.
     *
     * @Route("/cloturer/{id}2L55/c", name="commande_cloturer")
     */
    public function cloturerAction(Request $request, Commande $commande)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($commande->getUserConfirmes() as $userConfirme){
                $commande->removeUserConfirme($userConfirme);
            }

            $commande->setUserRefuser($this->getUser());
            $commande->setModifiable(false);
            $commande->setTexte($_POST['textCloturer']);

            $commande->setEtat(self::DEMANDE_CLOTURE);

            $em->persist($commande);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Con de commande n° '.$commande->getNumero().' clôturé');
            $historiqueGlobal->setLien($this->generateUrl('commande_afficher', array('id' => $commande->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------


            return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));

        }

        return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));

    }
    /**
     * nouveau entity.
     *
     * @Route("refuser/{id}2L55/c", name="commande_refuser")
     */
    public function refuserAction(Request $request, Commande $commande)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($commande->getUserConfirmes() as $userConfirme){
                $commande->removeUserConfirme($userConfirme);
            }

            $commande->setUserRefuser($this->getUser());
            $commande->setModifiable(true);
            $commande->setTexte($_POST['textRefuser']);

            $commande->setEtat(self::DEMANDE_REFUSER);

            $em->persist($commande);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Entré en stock n° '.$commande->getNumero().' refusé');
            $historiqueGlobal->setLien($this->generateUrl('commande_afficher', array('id' => $commande->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));

        }

        return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));

    }

    /**
     * nouveau entity.
     *
     * @Route("confirmer/500{id}2L55/bc", name="commande_confirme")
     */
    public function confirmerAction(Request $request, Commande $commande)
    {
        $em = $this->getDoctrine()->getManager();
        if($commande->getEtat() == self::DEMANDE_CONFIRME){
            return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));
        }

        //SCRIPT RECONFIRMATION
        if($commande->getUserRefuser()){
            $commande->setUserRefuser(null);
            $commande->setModifiable(false);

            $commande->setEtat(self::DEMANDE_ENATTENTE);
        }

        $commande->addUserConfirme($this->getUser());

//        TEST NOMBRE CONFIRMATION
        $nombreConfirmation = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'commande'
            ))->getNombre()
        ;

        if ($nombreConfirmation == count($commande->getUserConfirmes())){
            $this->demandeConfirme($commande, $em);
        }

        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute('commande_afficher', array('id' => $commande->getId()));
    }
    private function demandeConfirme(Commande $commande, ObjectManager $em){
        //        //Initialisation$repositoryStock = $em->getRepository('ProduitBundle:Stock_');


        $serviceProduit = new ProduitService($em);

        foreach ($commande->getLigneCommandes()as $ligneCommande) {

            //--------HISTORIQUE DU PRODUIT------------
            $historiqueProduit = new HistoriqueProduit();

            $historiqueProduit->setType('credit');
            $historiqueProduit->setProduit($ligneCommande->getProduit());
            $historiqueProduit->setCommande($commande);
            $historiqueProduit->setDate($commande->getDate());
            $historiqueProduit->setQuantite($ligneCommande->getQuantite());


            $em->persist($historiqueProduit);

        }



//        MODIFICATION DU ENTRE
        $commande->setEtat(self::DEMANDE_CONFIRME);
        $commande->setModifiable(false);
        $em->persist($commande);

        $em->flush();

    }
    /**
     * nouveau entity.
     *
     * @Route("/imprimer-commande/{id}", name="commande_imprimer")
     */
    public function imprimerAction(Request $request, Commande $commande){

        return $this->render('@Gestion/BonCommande/imprimer.html.twig', array(
            'commande' => $commande,
        ));
    }
    private function nextNumeroE(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'bon_entrée'
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
                'nom' => 'bon_entrée'
            ))
        ;
        $numero->setNumero($nextNum);
        $em->persist($numero);

    }
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

    /**
     * nouveau entity.
     *
     * @Route("/commande-entre/{id}", name="commande_entre")
     */
    public function commandeEntrerAction(Request $request,Commande $commande){
        $em = $this->getDoctrine()->getManager();
        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true));
        $fournisseurs =  $em->getRepository('FournisseurBundle:Fournisseur')->findAll();

        $repositorySite = $em->getRepository('GroupeBundle:Site');

        $sites = $repositorySite->findBy(
            array(),
            array('emplacement' => "asc")
        );
        if($request->getMethod() == 'POST'){
            $entre = new Entre();

            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $entre->setDate($date);
            $entre->setNumero($_POST['numero']);
            $entre->setUserCreer($this->getUser());

            if ($commande->getFournisseur())
            {
                $entre->setFournisseur($commande->getFournisseur());
            }
            if ($commande->getMotif())
                $entre->setMotif($commande->getMotif());

            // ------------------- EMPLACEMEMNT ---------------------

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $entre->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $entre->setDepot($depot);
            }
            $entre->setCommande($commande);

            // ------------------- ////// EMPLACEMEMNT ////// ---------------------

            //NEXT NUMERO
            $this->nextNumeroE($em);

            $em->persist($entre);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Entré en stock n° '.$entre->getNumero().' créer');
            $historiqueGlobal->setLien($this->generateUrl('entre_affcher', array('id' => $entre->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            //----------//// TEST TEST TEST ////------------------
           foreach ($commande->getLigneCommandes() as $valeur) {
               $ligne = new ligneEntre();
               $produit=$valeur->getProduit();
               $ligne->setDesignation($valeur->getDesignation());
               $ligne->setQuantite($valeur->getQuantite());
               $ligne->setEntre($entre);

               if ($valeur->getPrix())
                   $ligne->setPrixAchat($valeur->getPrix());

               if ($valeur->getUtilite())
                   $ligne->setUtilite($valeur->getUtilite());

               $repositoryProduit = $em->getRepository('ProduitBundle:Produit');
               $ligne->setProduit($produit);

               $em->persist($ligne);
               $em->flush();
           }


            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('entre_affcher', array('id' => $entre->getId()));


        }
        return $this->render('@Gestion/BonCommande/commandeToentre.html.twig', array(

            'numero' => $this->recupereNumeroEntre($em),
            'depots' => $depots,
            'sites' => $sites,
        ));
    }
}
