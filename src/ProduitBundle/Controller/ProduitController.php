<?php

namespace ProduitBundle\Controller;

use AppBundle\Services\ProduitService;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\HistoriqueGlobal;
/**
 * Produit controller.
 *
 *
 */
class ProduitController extends Controller
{

    /**
     * Lists all produit entities.
     *
     * @Route("/liste-produit", name="produit_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();
        $repositoryDepot =  $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array('etat'=>true),array('id' => 'asc'));

        return $this->render('@Produit/produit/index.html.twig', array(
            'produits' => $produits,
            'depots' => $depots,
        ));
    }

    /**
     * Creates a new produit entity.
     *
     * @Route("/nouveau", name="produit_new")
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('ProduitBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

           // ---HISTORIQUE GLOBAL-----

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setLibelle('Ajout d\'un nouveau produit '.$produit->getDesignation());
            $historiqueGlobal->setDate(new \DateTime());
            $historiqueGlobal->setLien($this->generateUrl('produit_show', array('id' =>$produit->getId() )));
            $historiqueGlobal->setUserHistorique($this->getUser());
            $em->persist($historiqueGlobal);
            $em->flush();

            //---HISTORIQUE GLOBAL-----

            return $this->redirectToRoute('produit_show', array('id' => $produit->getId()));
        }

        return $this->render('@Produit/produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));

    }

    /**
     * Finds and displays a produit entity.
     *
     * @Route("/KL{id}25O/500", name="produit_show")
     */
    public function showAction(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager();

        $repositoryDepot =  $em->getRepository('ProduitBundle:Depot');
        $depots = $repositoryDepot->findBy(array(),array('id' => 'asc'));

        $repositoryStock = $em->getRepository('ProduitBundle:Stock_');

        $listeSiteStockages = array();

        $qb = $repositoryStock->createQueryBuilder('s');
        $stockSites = $qb
            ->where($qb->expr()->isNotNull('s.site'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($stockSites as $stockSite){
            if (! in_array($stockSite->getSite(), $listeSiteStockages)){
                array_push($listeSiteStockages, $stockSite->getSite());
            }
        }

        return $this->render('@Produit/produit/show.html.twig', array(
            'produit' => $produit,
            'depots' => $depots,
            'listeSiteStockages' => $listeSiteStockages
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     * @Route("/LO5{id}66/modifier", name="produit_edit")
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('ProduitBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);
        $em=$this->getDoctrine()->getManager();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information sur le produit '.$produit->getDesignation().' modifié');
            $historiqueGlobal->setLien($this->generateUrl('produit_show', array('id' => $produit->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('produit_edit', array('id' => $produit->getId()));
        }

        return $this->render('@Produit/produit/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/{id}", name="produit_delete")
     */
    public function deleteAction(Request $request, Produit $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('produit_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produit $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Lists all produit entities.
     *
     * @Route("/all/200/update", name="produit_all_update_")
     */
    public function allUpdateAction(){
        $em = $this->getDoctrine()->getManager();

        $repositoryProduit = $em->getRepository('ProduitBundle:Produit');

        $produitService = new ProduitService($em);

        $produits = $repositoryProduit->findAll();
        foreach ($produits as $produit){
            $produitService->updateStockTotal($produit);
        }

        $em->flush();

        return new Response('Base de données produit mis-à-jour');
    }


}
