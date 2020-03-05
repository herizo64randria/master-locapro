<?php

namespace ProduitBundle\Controller;

use AppBundle\Services\ProduitService;
use ProduitBundle\Entity\HistoriqueImmo;
use ProduitBundle\Entity\Immo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Immo controller.
 *
 * @Route("immobilier")
 */
class ImmoController extends Controller
{
    /**
     * Lists all immo entities.
     *
     * @Route("/", name="immo_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $immos = $em->getRepository('ProduitBundle:Immo')->findAll();

        return $this->render('@Produit/immo/index.html.twig', array(
            'immos' => $immos,
        ));
    }

    /**
     * Creates a new immo entity.
     *
     * @Route("/nouveau", name="immo_new")
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $immo = new Immo();
        $form = $this->createForm('ProduitBundle\Form\ImmoType', $immo);
        $form->handleRequest($request);

        $repositorySite = $em->getRepository('GroupeBundle:Site');

        $sites = $repositorySite->findBy(
            array(),
            array('emplacement' => "asc")
        );

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');

        $depots = $repositoryDepot->findBy(
            array(),
            array('nom' => "asc")
        );


        if ($form->isSubmitted() && $form->isValid()) {

            $historiqueImmo = new HistoriqueImmo();
            $historiqueImmo->setImmo($immo);
            $historiqueImmo->setDate(new \DateTime());
            $historiqueImmo->setMotif('Création de l\'Immo');

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $historiqueImmo->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $historiqueImmo->setDepot($depot);
            }

            $em->persist($historiqueImmo);
            $em->persist($immo);
            
            $em->flush();

            $produitSercice = new ProduitService($em);
            $produitSercice->emplacementImmo($immo);

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Nouvel Immo créé');
            $historiqueGlobal->setLien($this->generateUrl('immo_show', array('id' => $immo->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            return $this->redirectToRoute('immo_show', array('id' => $immo->getId()));
        }

        return $this->render('@Produit/immo/new.html.twig', array(
            'immo' => $immo,
            'form' => $form->createView(),
            'sites' => $sites,
            'depots' => $depots,
        ));
    }

    /**
     * Finds and displays a immo entity.
     *
     * @Route("/500{id}/afficher", name="immo_show")
     *
     */
    public function showAction(Immo $immo)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($immo);

        $repositorySite = $em->getRepository('GroupeBundle:Site');

        $sites = $repositorySite->findBy(
            array(),
            array('emplacement' => "asc")
        );

        $repositoryDepot = $em->getRepository('ProduitBundle:Depot');

        $depots = $repositoryDepot->findBy(
            array(),
            array('nom' => "asc")
        );

        return $this->render('@Produit/immo/show.html.twig', array(
            'immo' => $immo,
            'delete_form' => $deleteForm->createView(),
            'sites' => $sites,
            'depots' => $depots,
        ));
    }

    /**
     * Displays a form to edit an existing immo entity.
     *
     * @Route("/{id}/modifier/info", name="immo_edit")
     *
     */
    public function editAction(Request $request, Immo $immo)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($immo);
        $editForm = $this->createForm('ProduitBundle\Form\ImmoType', $immo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Modification d\'information dans Immo '.$immo->getCode());
            $historiqueGlobal->setLien($this->generateUrl('immo_show', array('id' => $immo->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('immo_show', array('id' => $immo->getId()));
        }

        return $this->render('@Produit/immo/edit.html.twig', array(
            'immo' => $immo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a immo entity.
     *
     * @Route("/{id}", name="immo_delete")
     *
     */
    public function deleteAction(Request $request, Immo $immo)
    {
        $form = $this->createDeleteForm($immo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($immo);
            $em->flush();
        }

        return $this->redirectToRoute('immo_index');
    }

    /**
     * Creates a form to delete a immo entity.
     *
     * @param Immo $immo The immo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Immo $immo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('immo_delete', array('id' => $immo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Deletes a immo entity.
     *
     * @Route("/{id}500/deplacer-vers", name="immo_deplacer")
     *
     */
    public function deplacerAction(Request $request, Immo $immo){
        $em = $this->getDoctrine()->getManager();

        $ancienEmplacement = '';
        $nouveauEmplacement = '';

        if ($immo->getDepot()){
            $ancienEmplacement = 'dans le depot '.$immo->getDepot()->getNom();
        }
        if ($immo->getSite()){
            $ancienEmplacement = 'dans le site '.$immo->getSite()->getEmplacement();
        }


        if ($request->getMethod() == 'POST'){
            $repositorySite = $em->getRepository('GroupeBundle:Site');
            $repositoryDepot = $em->getRepository('ProduitBundle:Depot');

            $historiqueImmo = new HistoriqueImmo();
            $historiqueImmo->setImmo($immo);
            $historiqueImmo->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateDeplacement']));
            $historiqueImmo->setMotif($_POST['motifDeplacement']);
            $historiqueImmo->setDescription($_POST['descriptionDeplacement']);

            if($_POST['emplacement'] == 'site'){
                $site = $repositorySite->findOneBy(array('id' => $_POST['site']));
                $historiqueImmo->setSite($site);
            }

            if ($_POST['emplacement'] == "depot"){
                $depot = $repositoryDepot->findOneBy(array('id' => $_POST['depot']));
                $historiqueImmo->setDepot($depot);
            }

            $em->persist($historiqueImmo);
            $em->persist($immo);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $produitSercice = new ProduitService($em);
            $produitSercice->emplacementImmo($immo);

            if ($immo->getDepot()){
                $nouveauEmplacement = 'le depot '.$immo->getDepot()->getNom();
            }
            if ($immo->getSite()){
                $nouveauEmplacement = 'le site '.$immo->getSite()->getEmplacement();
            }

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Déplacement de l\'immo '.$immo->getCode().' '.$ancienEmplacement.' vers '.$nouveauEmplacement);
            $historiqueGlobal->setLien($this->generateUrl('immo_show', array('id' => $immo->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------



            return $this->redirectToRoute('immo_show', array('id' => $immo->getId()));
        }
        throw new Exception("Erreur 404 NOT-FOUND");
    }
}
