<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Huile;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Huile controller.
 *
 * @Route("stock-huile")
 */
class HuileController extends Controller
{
    /**
     * Lists all huile entities.
     *
     * @Route("/", name="huile_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $huiles = $em->getRepository('ProduitBundle:Produit')->findBy(array(
            'siHuile' => true
        ));

        return $this->render('@Produit/huile/index.html.twig', array(
            'huiles' => $huiles,
        ));
    }

    /**
     * Creates a new huile entity.
     *
     * @Route("/new", name="huile_new")
     *
     */
    public function newAction(Request $request)
    {
        $huile = new Produit();
        $form = $this->createForm('ProduitBundle\Form\ProduitType', $huile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $huile->setSiHuile(true);

            $em->persist($huile);
            $em->flush();
            // ---HISTORIQUE GLOBAL-----

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setLibelle('Ajout d\'une référence huile');
            $historiqueGlobal->setDate(new \DateTime());
            $historiqueGlobal->setLien($this->generateUrl('huile_show', array('id' =>$huile->getId() )));
            $historiqueGlobal->setUserHistorique($this->getUser());
            $em->persist($historiqueGlobal);
            $em->flush();

            //---HISTORIQUE GLOBAL-----


            return $this->redirectToRoute('huile_show', array('id' => $huile->getId()));
        }

        return $this->render('@Produit/huile/new.html.twig', array(
            'huile' => $huile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a huile entity.
     *
     * @Route("/{id}", name="huile_show")
     *
     */
    public function showAction(Produit $huile)
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

        return $this->render('@Produit/huile/show.html.twig', array(
            'huile' => $huile,
            'depots' => $depots,
            'listeSiteStockages' => $listeSiteStockages
        ));
    }

    /**
     * Displays a form to edit an existing huile entity.
     *
     * @Route("/modifier/500{id}500", name="huile_edit")
     *
     */
    public function editAction(Request $request, Produit $huile)
    {

        $editForm = $this->createForm('ProduitBundle\Form\ProduitType', $huile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // ---HISTORIQUE GLOBAL-----

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setLibelle("Modification d'information sur l'huile");
            $historiqueGlobal->setDate(new \DateTime());
            $historiqueGlobal->setLien($this->generateUrl('huile_show', array('id' =>$huile->getId() )));
            $historiqueGlobal->setUserHistorique($this->getUser());
            $em->persist($historiqueGlobal);
            $em->flush();

            //---HISTORIQUE GLOBAL-----

            return $this->redirectToRoute('huile_show', array('id' => $huile->getId()));
        }

        return $this->render('@Produit/huile/edit.html.twig', array(
            'huile' => $huile,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a huile entity.

     *
     */
    public function deleteAction(Request $request, Produit $huile)
    {
        $form = $this->createDeleteForm($huile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($huile);
            $em->flush();
        }

        return $this->redirectToRoute('huile_index');
    }

    /**
     * Creates a form to delete a huile entity.
     *
     * @param Huile $huile The huile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Huile $huile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('huile_delete', array('id' => $huile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Finds and displays a huile entity.
     *
     * @Route("/huile/par-defaut/{id}", name="huile_parDefaut")
     *
     */
    public function huileParDefautAction(Produit $huile)
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryHuile = $em->getRepository(Produit::class);
        $huiles = $repositoryHuile->findBy(array(
            'siHuile' => true
        ));

        foreach ($huiles as $huile_){
            $huile_ ->setHuileParDefaut(null);
            $em->persist($huile_);
        }

        $huile->setHuileParDefaut(true);
        $em->persist($huile);

        $em->flush();

        return $this->redirectToRoute('huile_show', array('id' => $huile->getId()));
    }


}
