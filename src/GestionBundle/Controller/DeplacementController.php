<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Deplacement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Services\GestionService;
use AppBundle\Services\ProduitService;
use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\Entre;
use GestionBundle\Entity\ligneEntre;
use GestionBundle\Entity\NumDoc;
use ProduitBundle\Entity\HistoriqueProduit;
use ProduitBundle\Entity\Stock_;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use GestionBundle\Entity\ligneDeplacement;


class DeplacementController extends Controller
{

    const TRANSFERT_CONFIRME = 'Transfert confirmée';
    const TRANSFERT_ATTENTE = 'Transfert en attente de confirmation';
    const TRANSFERT_REFUSER = 'Transfert refusée';
    const TRANSFERT_CLOTURE = 'Transfert clôturée';
    const TRANSFERT_ATTENTE_REC = 'Transfert en attente de reconfirmation';
    // DEBUT ----- FONCTION recupereNumero et next numero -----

    private function recupereNumeroEntre(ObjectManager $em){
//        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'transfert'
        ));

        if(! $entityNumero){
            $newNum = new NumDoc();
            $newNum->setNumero('001');
            $newNum->setNom('transfert');

            $em->persist($newNum);
            $em->flush();

            $entityNumero = $newNum;
        }

        $numero = 'TRS-'.$entityNumero->getNumero().'/'.$date->format('Y');

        return $numero;

    }

    private function nextNumero($em){
//        $em = $this->getDoctrine()->getManager();

        $repositoryNumero = $em->getRepository('GestionBundle:NumDoc');
        $entityNumero = $repositoryNumero->findOneBy(array(
            'nom' => 'transfert'
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
                'nom' => 'transfert'
            ))
        ;
        $numero->setNumero($nextNum);
        $em->persist($numero);

    }

    // FIN ----- FONCTION recupereNumero et next numero -----

    /**
     *test
     *
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        $date1 = \DateTime::createFromFormat('d/m/Y', '01/08/2019');
        $date2 = \DateTime::createFromFormat('d/m/Y', '20/08/2019');


        $dates = array(
            array(
                'date' => \DateTime::createFromFormat('d/m/Y', '10/08/2019'),
                'etat' => 'Arrêt'
            ),
            array(
                'date' => \DateTime::createFromFormat('d/m/Y', '12/08/2019'),
                'etat' => 'Marche'
            ),
            array(
                'date' => \DateTime::createFromFormat('d/m/Y', '15/08/2019'),
                'etat' => 'Arrêt'
            ),
            array(
                'date' => \DateTime::createFromFormat('d/m/Y', '16/08/2019'),
                'etat' => 'Marche'
            ),
            array(
                'date' => \DateTime::createFromFormat('d/m/Y', '17/08/2019'),
                'etat' => 'Marche'
            ),
            array(
                'date' => \DateTime::createFromFormat('d/m/Y', '19/08/2019'),
                'etat' => 'Arrêt'
            ),
        );

        $nbMarche = $this->calculDate($date1, $date2, $dates, 20);

        return new Response(var_dump('Jour :'.$nbMarche." -- En heure:".$nbMarche*24 .'H' ));

    }
    private function calculDate(\DateTime $debut, \DateTime $fin, $dates, $heureJour){


        $nbJour = $this->diffDate($debut, $fin);

        $test=array(
            'date'=>$debut,
            'etat'=>'Marche',

        );
        $arret = 0;

       foreach ($dates as  $date)
       {
           if($date['etat']=='Arrêt')
           {
               $test = $date;
           }

           if($date['etat'] == 'Marche' and $test['etat'] == 'Arrêt') {
                $arret = $arret + $this->diffDate($test['date'], $date['date']);
                $test = $date;
           }
           elseif ($date['etat'] == 'Marche' and $test['etat'] == 'Marche')
           {
               $test = $date;
           }

           if ($date['etat'] == 'Arrêt' and  $date == $dates[(count($dates) - 1)])
           {
               $arret = $arret + $this->diffDate($date['date'], $fin);
           }

       }

       $nbMarche = $nbJour - $arret;

       return $nbMarche;

    }

    private function diffDate($date_petit,$date_grand)
    {

        $interval = $date_grand->diff($date_petit);

        $res= $interval->format('%a');

       return $res;
    }
    /**
     * INDEX
     *
     * @Route("/liste-deplacement", name="deplacement_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $deplacements = $em->getRepository('GestionBundle:Deplacement')
            ->findAll()
        ;

        return $this->render('@Gestion/Deplacement/index.html.twig', array(
            'deplacements' => $deplacements,

        ));

    }
    /**
     * nouveau entity.
     *
     * @Route("/nouveau-transfert", name="transfert_creer")
     */
    public function creerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true));

        if($request->getMethod() == 'POST'){
            $deplacement = new Deplacement();
            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $deplacement->setDate($date);
            $deplacement->setDate(new \DateTime());
            $deplacement->setNumero($_POST['numero']);
            $deplacement->setUserCreer($this->getUser());

            if (isset($_POST['motif']))
                $deplacement->setMotif($_POST['motif']);

            $sourcedepot = $repositoryDepot->findOneBy(array(
                'id' => $_POST['source_depot']
            ));
            $deplacement->setSourcedepot($sourcedepot);
            $destinationdepot = $repositoryDepot->findOneBy(array(
                'id' => $_POST['destination_depot']
            ));
            $deplacement->setDestinationdepot($destinationdepot);

            //NEXT NUMERO
            $this->nextNumero($em);

            $em->persist($deplacement);
            $em->flush();

            return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));

        }

        return $this->render('@Gestion/Deplacement/new.html.twig', array(
            'numero' => $this->recupereNumeroEntre($em),
            'depots' => $depots,

        ));

    }
    /**
     * deplacement entity.
     *
     * @Route("/modifier-transfert/ADF43{id}71F", name="transfert_edit")
     */
    public function deplacementMofifierAction(Request $request,Deplacement $deplacement)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true));


        if($request->getMethod() == 'POST'){



            $date = \DateTime::createFromFormat('d/m/Y',$_POST['date']);
            $deplacement->setDate($date);

            if ($deplacement->getEtat()=='Transfert en attente de confirmation' or $deplacement->getEtat()=='Transfert confirmée'){
                $em->flush();

                return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));
            }

            if (isset($_POST['motif']))
                $deplacement->setMotif($_POST['motif']);

            $sourcedepot = $repositoryDepot->findOneBy(array(
                'id' => $_POST['source_depot']
            ));
            $deplacement->setSourcedepot($sourcedepot);
            $destinationdepot = $repositoryDepot->findOneBy(array(
                'id' => $_POST['destination_depot']
            ));
            $deplacement->setDestinationdepot($destinationdepot);

            if (isset($_POST['source_depot']) and $_POST['source_depot'])
            {
                $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
                $depot = $repositoryDepot->findOneBy(array(
                    'id' => $_POST['source_depot']
                ));
                $deplacement->setSourcedepot($depot);
            }
            if (isset($_POST['destination_depot']) and $_POST['destination_depot'])
            {
                $repositoryDepot = $em->getRepository('ProduitBundle:Depot');
                $depot = $repositoryDepot->findOneBy(array(
                    'id' => $_POST['destination_depot']
                ));
                $deplacement->setDestinationdepot($depot);
            }

            $em->persist($deplacement);
            $em->flush();

            return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));

        }

        return $this->render('@Gestion/Deplacement/edit.html.twig', array(
            'numero' => $this->recupereNumeroEntre($em),
            'depots' => $depots,
            'deplacement' => $deplacement,

        ));

    }
    /**
     * Deplacement entity.
     *
     * @Route("/500{id}2L55/enregistrer-transfert", name="transfert_enregistrer")
     */
    public function transfertEnregistrerAction(Request $request, Deplacement $deplacement){

        $em = $this->getDoctrine()->getManager();
        if(! $deplacement->getModifiable())
            throw new Exception('Erreur! Ce document est déjà enregistré');

        $serviceGestion = new GestionService($em);
        if($serviceGestion->testErreurLigne1($deplacement) > 0){
            throw new Exception('Erreur! Les lignes de ce document possède des erreurs');

        }

//        MODIFICATION DU DEPLACEMENT
        $deplacement->setEtat(self::TRANSFERT_ATTENTE);
        $deplacement->setModifiable(false);
        $em->persist($deplacement);

        $em->flush();

        return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));
    }

    /**
     * deplacement entity.
     *
     * @Route("confirmer-transfert/500{id}2L55/s", name="transfert_confirmer")
     */
    public function confirmerTrasfertAction(Request $request, Deplacement $deplacement)
    {
        $em = $this->getDoctrine()->getManager();
        if($deplacement->getEtat() == self::TRANSFERT_CONFIRME){
            return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));
        }

        //SCRIPT RECONFIRMATION
        if($deplacement->getUserRefuser()){
            $deplacement->setUserRefuser(null);
            $deplacement->setModifiable(false);

            $deplacement->setEtat(self::TRANSFERT_ATTENTE);
        }

        $deplacement->addUserConfirme($this->getUser());

//        TEST NOMBRE CONFIRMATION
        $nombreConfirmation = $em->getRepository('AdminBundle:NombreConfirmation')
            ->findOneBy(array(
                'nomDemande' => 'transfert'
            ))->getNombre()
        ;

        if ($nombreConfirmation == count($deplacement->getUserConfirmes())){
            $this->transfertConfirme($em,$deplacement);
        }

        $em->persist($deplacement);
        $em->flush();

        return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));
    }

    /**
     * nouveau entity.
     *
     * @Route("/afficher-deplacement/AD15{id}E35", name="deplacement_affcher")
     */
    public function afficherAction(Request $request, Deplacement $deplacement){

        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();

        return $this->render('@Gestion/Deplacement/show.html.twig', array(
            'deplacement' => $deplacement,
            'produits' => $produits,
        ));
    }

    /**
     * nouveau entity.
     *
     * @Route("/ajouter-ligne-deplacement/F71A{id}3CF", name="deplacement_ajouterLigne")
     */
    public function ajouterLigneAction(Request $request,Deplacement $deplacement)
    {
        if($_POST['quantite'] <= 0 )
            throw new Exception('Erreur! La quantité doit être supérieur à zéro(0)');

        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){



            $idProduit = $_POST['produit'];

            //--------- --- TEST TEST TEST ---------------------

            $error = null;
            if ($_POST['quantite'] <= 0){
                $error = "Erreur! La quantité doit être supérieur à zéro(0)";
            }

            if($error)
                throw new Exception($error);


            //----------//// TEST TEST TEST ////------------------

            $ligne = new ligneDeplacement();
            $ligne->setDesignation($_POST['designation']);
            $ligne->setQuantite($_POST['quantite']);
            $ligne->setDeplacement($deplacement);

            $repositoryProduit = $em->getRepository('ProduitBundle:Produit');
            $produit = $repositoryProduit->findOneBy(array('id' => $idProduit));

            //TEST DU QUANTITE
            $serviceProduit = new ProduitService($em);
            if($ligne->getQuantite() > $serviceProduit->getStock($produit, $deplacement->getSourcedepot()))
                throw new Exception('Erreur! La quantité est supérieur que le stock dans le dépot');
            //-----------------------

            $ligne->setProduit($produit);

            $em->persist($ligne);
            $em->flush();

            return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));
        }

        throw new Exception('Erreur! 404 Not-Found');

    }

    public function transfertConfirme(ObjectManager $em , Deplacement $deplacement){

        $repositoryStock = $em->getRepository('ProduitBundle:Stock_');

        $serviceProduit = new ProduitService($em);

        foreach ($deplacement->getLignedeplacement() as $ligneDeplacement){

            //--------HISTORIQUE DU PRODUIT------------
            $historiqueProduit = new HistoriqueProduit();

            $historiqueProduit->setType('debit');
            $historiqueProduit->setProduit($ligneDeplacement->getProduit());
            $historiqueProduit->setDeplacement($deplacement);
            $historiqueProduit->setDepot($deplacement->getSourcedepot());
            $historiqueProduit->setDate($deplacement->getDate());
            $historiqueProduit->setQuantite($ligneDeplacement->getQuantite());

            $em->persist($historiqueProduit);
            $historiqueProduit1 = new HistoriqueProduit();

            $historiqueProduit1->setType('credit');
            $historiqueProduit1->setProduit($ligneDeplacement->getProduit());
            $historiqueProduit1->setDeplacement($deplacement);
            $historiqueProduit1->setDepot($deplacement->getDestinationdepot());
            $historiqueProduit1->setDate($deplacement->getDate());
            $historiqueProduit1->setQuantite($ligneDeplacement->getQuantite());

            $em->persist($historiqueProduit1);
            //--------------------------------------------

            //----------------- DANS LE STOCK SOURCE-----------------

            $stock_source = $repositoryStock->findOneBy(array(
                'produit' => $historiqueProduit->getProduit(),
                'depot' => $historiqueProduit->getDepot()
            ));

           /* if(!$stock_source){
                $stock = new Stock_();
                $stock->setDepot($historiqueProduit->getDepot());
                $stock->setProduit($historiqueProduit->getProduit());
                $stock->setQuantite(0);
            }*/

            $quantite = $stock_source->getQuantite() - $historiqueProduit->getQuantite();
            $stock_source->setQuantite($quantite);

            $em->persist($stock_source);
            $em->flush();
            //------------------------------------------------

            //----------------- DANS LE STOCK DESTINATION-----------------

            $stock_destination = $repositoryStock->findOneBy(array(
                'produit' => $historiqueProduit1->getProduit(),
                'depot' => $historiqueProduit1->getDepot()
            ));

             if(!$stock_destination){
                 $stock_destination = new Stock_();
                 $stock_destination->setDepot($historiqueProduit1->getDepot());
                 $stock_destination->setProduit($historiqueProduit1->getProduit());
                 $stock_destination->setQuantite(0);
             }

            $quantite1 = $stock_destination->getQuantite() + $historiqueProduit1->getQuantite();
            $stock_destination->setQuantite($quantite1);

            $em->persist($stock_destination);
            $em->flush();
            //------------------------------------------------


            //--------UPDATE STOCK TOTAL-----------------
            $produit = $historiqueProduit->getProduit();
            $serviceProduit->updateStockTotal($produit);
            $em->flush();

        }

//        MODIFICATION DU ENTRE
        $deplacement->setEtat(self::TRANSFERT_CONFIRME);
        $deplacement->setModifiable(false);
        $em->persist($deplacement);

        $em->flush();


    }

    /**
     * Deplacement entity.
     *
     * @Route("refuser/{id}2L55/d", name="transfert_refuser")
     */
    public function refuserAction(Request $request, Deplacement $deplacement)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($deplacement->getUserConfirmes() as $userConfirme){
                $deplacement->removeUserConfirme($userConfirme);
            }

            $deplacement->setUserRefuser($this->getUser());
            $deplacement->setModifiable(true);
            $deplacement->setTexte($_POST['text']);

            $deplacement->setEtat(self::TRANSFERT_REFUSER);

            $em->persist($deplacement);
            $em->flush();

            return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));

        }

        return $this->redirectToRoute('deplacement_affcher', array('id' => $deplacement->getId()));

    }
    /**
     * Deplacement entity.
     *
     * @Route("/cloturer/{id}2L55/d", name="transfert_cloturer")
     */
    public function cloturerAction(Request $request, Deplacement $deplacement)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() ==  'POST'){

            //VIder table acceptaion
            foreach ($deplacement->getUserConfirmes() as $userConfirme){
                $deplacement->removeUserConfirme($userConfirme);
            }

            $deplacement->setUserRefuser($this->getUser());
            $deplacement->setModifiable(false);
            $deplacement->setTexte($_POST['text']);

            $deplacement->setEtat(self::TRANSFERT_CLOTURE);

            $em->persist($deplacement);
            $em->flush();

            return $this->redirectToRoute('sortie_afficher', array('id' => $deplacement->getId()));

        }

        return $this->redirectToRoute('sortie_afficher', array('id' => $deplacement->getId()));

    }
    /**
     * LigneDeplacement entity.
     *
     * @Route("/ligne/modifier/ADCF89{id}2L55", name="deplacement_modifierLigne")
     */
    public function modifierLigneAction(Request $request, ligneDeplacement $ligneDeplacement){

        if(!$ligneDeplacement->getDeplacement()->getModifiable())
            throw new Exception('Erreur: Ce document n\'est plus modifiable');

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST'){
            $ligneDeplacement->setDesignation($_POST['designation']);
            $ligneDeplacement->setQuantite($_POST['quantite']);

            $em->persist($ligneDeplacement);
            $em->flush();

            return $this->redirectToRoute('deplacement_affcher', array('id' => $ligneDeplacement->getDeplacement()->getId()));
        }

        return $this->render('@Gestion/Deplacement/editLigneDeplacement.html.twig', array(
            'ligneDeplacement' => $ligneDeplacement,
        ));

    }
    /**
     * Supprimer entity.
     *
     * @Route("/ligne/DEF34{id}2L5/supprimer", name="deplacement_supprimerLigne")
     */
    public function supprimerLigneAction(Request $request, ligneDeplacement $ligneDeplacement){
        $em = $this->getDoctrine()->getManager();

        $sortie = $ligneDeplacement->getDeplacement();

        $em->remove($ligneDeplacement);
        $em->flush();

        return $this->redirectToRoute('deplacement_affcher', array('id' => $ligneDeplacement->getDeplacement()->getId()));
    }


}
