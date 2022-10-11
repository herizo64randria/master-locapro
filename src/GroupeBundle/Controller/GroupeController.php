<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Alternateur;
use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HeureMarche;
use GroupeBundle\Entity\Moteur;
use ProduitBundle\Entity\Stock_;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\GroupeService;
use UserBundle\Entity\HistoriqueGlobal;


/**
 * Groupe controller.
 *
 * @Route("groupe")
 */
class GroupeController extends Controller
{

    /**
     * Lists all groupe entities.
     *
     * @Route("/liste", name="groupe_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mission =  "mission";
        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();
        $sites = $em->getRepository('GroupeBundle:Site')->findBy(
            array(),
            array('emplacement' => 'asc'))
        ;
    
        $sql = "SELECT *from mission limit 2";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $this->render('@Groupe/groupe/index.html.twig', array(
            'groupes' => $groupes,
            'mission'=>$result,
            'sites'=>$sites,
        ));
    }

    /**
     * Lists all groupe entities.
     *
     * @Route("/indexer/log", name="groupe_indexiation")
     *
     */
    public function indexerLogAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('GroupeBundle:Groupe')->findAll();


        foreach ($groupes as $groupe){
            if(!$groupe->getMoteur()){
                $moteur = new Moteur();
                $moteur->setMarque('-');
                $moteur->setModele('-');
                $moteur->setNumeroSerie('-');
                $moteur->setAnnee(0);
                $moteur->setPuissance(0);
                $groupe->setMoteur($moteur);

                $em->persist($moteur);
                $em->persist($groupe);
            }

            if(!$groupe->getAlternateur()){
                $alternateur = new Alternateur();
                $alternateur->setMarque('-');
                $alternateur->setModele('-');
                $alternateur->setNumeroSerie('-');
                $alternateur->setAnnee(0);
                $alternateur->setPuissance(0);

                $groupe->setAlternateur($alternateur);
                $em->persist($alternateur);
                $em->persist($groupe);
            }
        }

        $em->flush();

        return new Response('OK');
    }


    /**
     * Creates a new groupe entity.
     *
     * @Route("/inscrire", name="groupe_new")
     *
     */
    public function newAction(Request $request)
    {
        $groupe = new Groupe();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('GroupeBundle\Form\GroupeType', $groupe);
        $form->handleRequest($request);

        $catalogues = $em->getRepository('GroupeBundle:Catalogue')->findBy(
            array(),
            array('titre' => 'asc')
        );

        $sites = $em->getRepository('GroupeBundle:Site')->findBy(
            array(),
            array('emplacement' => 'asc'))
        ;

        if ($form->isSubmitted() && $form->isValid()) {

            $site = $em->getRepository('GroupeBundle:Site')->findOneBy(array(
                'id' => $_POST['site']
            ));

            $groupe->setSite($site);

            $etatGroupe = $em->getRepository('GroupeBundle:ListeEtatGroupe')->findOneBy(array(
                'id' => $_POST['etatGroupe']
            ));

            $groupe->setEtatGroupe($etatGroupe);

            $catalogue = $em->getRepository('GroupeBundle:Catalogue')->findOneBy(
                array('id' => $_POST['catalogue'])
            );

            $groupe->setCatalogue($catalogue);

            if (isset($_POST['groupe_dateDebutServce']))
                $groupe->setDateDebutService(\DateTime::createFromFormat('d/m/Y',$_POST['groupe_dateDebutServce']));

            //--------------- MOTEUR  ---------------
            $moteur = new Moteur();
            $moteur->setMarque($_POST['moteur_marque']);
            $moteur->setModele($_POST['moteur_modele']);
            $moteur->setNumeroSerie($_POST['moteur_numeroSerie']);
            $moteur->setAnnee($_POST['moteur_annee']);
            $moteur->setPuissance($_POST['moteur_puissance']);

            if (isset($_POST['moteur_dateDebutService']))
                $moteur->setDateDebutService(\DateTime::createFromFormat('d/m/Y',$_POST['moteur_dateDebutServce']));

            $em->persist($moteur);

            $groupe->setMoteur($moteur);

            //--------------- ALTERNATEUR  ---------------
            $alternateur = new Alternateur();
            $alternateur->setMarque($_POST['alternateur_marque']);
            $alternateur->setModele($_POST['alternateur_modele']);
            $alternateur->setNumeroSerie($_POST['alternateur_numeroSerie']);
            $alternateur->setAnnee($_POST['alternateur_annee']);
            $alternateur->setPuissance($_POST['alternateur_puissance']);

            if (isset($_POST['alternateur_dateDebutServce']))
                $alternateur->setDateDebutService(\DateTime::createFromFormat('d/m/Y',$_POST['alternateur_dateDebutServce']));

            $em->persist($alternateur);

            $groupe->setalternateur($alternateur);

            $em->persist($groupe);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Nouveau groupe créé: '.$groupe->getNumero());
            $historiqueGlobal->setLien($this->generateUrl('groupe_show', array('id' => $groupe->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));
        }

        return $this->render('@Groupe/groupe/new.html.twig', array(
            'groupe' => $groupe,
            'form' => $form->createView(),
            'sites' => $sites,
            'catalogues' => $catalogues,
        ));
    }

    /**
     * Finds and displays a groupe entity.
     *
     * @Route("/{id}", name="groupe_show")
     *
     */
    public function showAction(Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($groupe);

        $sites = $em->getRepository('GroupeBundle:Site')->findBy(
            array(),
            array('emplacement' => 'asc'))
        ;

        $listePieces = $groupe->getListepieces();

        $historiqueGroupes = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findBy(
            array('groupe' => $groupe),
            array('date' => 'desc')
        );

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

        $stockProduits = array();

        $stockSites = $repositoryStock->findBy(array(
            'site' => $groupe->getSite()
        ));

        foreach ($stockSites as $stock){
            if($stock->getQuantite() > 0)
                array_push($stockProduits, $stock);
        }

        // ------------------- ////// STOCK D'HUILE ////// ---------------------

        return $this->render('@Groupe/groupe/show.html.twig', array(
            'groupe' => $groupe,
            'delete_form' => $deleteForm->createView(),
            'sites' => $sites,
            'historiqueGroupes' => $historiqueGroupes,
            'listePieces' => $listePieces,
            'stockHuile' => $stockHuile,
            'stockProduits' => $stockProduits
        ));
    }

    /**
     * Displays a form to edit an existing groupe entity.
     *
     * @Route("/{id}/edit", name="groupe_edit")
     *
     */
    public function editAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($groupe);
        $editForm = $this->createForm('GroupeBundle\Form\GroupeType', $groupe);
        $editForm->handleRequest($request);

        $catalogues = $em->getRepository('GroupeBundle:Catalogue')->findBy(
            array(),
            array('titre' => 'asc')
        );



        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $etatGroupe = $em->getRepository('GroupeBundle:ListeEtatGroupe')->findOneBy(array(
                'id' => $_POST['etatGroupe']
            ));

            $groupe->setEtatGroupe($etatGroupe);

            $catalogue = $em->getRepository('GroupeBundle:Catalogue')->findOneBy(
                array('id' => $_POST['catalogue'])
            );

            $groupe->setCatalogue($catalogue);

            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information du groupe  '.$groupe->getNumero().' modifié');
            $historiqueGlobal->setLien($this->generateUrl('groupe_show', array('id' => $groupe->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));
        }

        return $this->render('@Groupe/groupe/edit.html.twig', array(
            'groupe' => $groupe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'catalogues' => $catalogues
        ));
    }

    /**
     * Deletes a groupe entity.
     *
     * @Route("/{id}", name="groupe_delete")
     *
     */
    public function deleteAction(Request $request, Groupe $groupe)
    {
        $form = $this->createDeleteForm($groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupe);
            $em->flush();
        }

        return $this->redirectToRoute('groupe_index');
    }

    /**
     * Creates a form to delete a groupe entity.
     *
     * @param Groupe $groupe The groupe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Groupe $groupe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groupe_delete', array('id' => $groupe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
