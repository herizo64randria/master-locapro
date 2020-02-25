<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Huile;
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

        $huiles = $em->getRepository('ProduitBundle:Huile')->findAll();

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
        $huile = new Huile();
        $form = $this->createForm('ProduitBundle\Form\HuileType', $huile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
    public function showAction(Huile $huile)
    {


        return $this->render('@Produit/huile/show.html.twig', array(
            'huile' => $huile,
        ));
    }

    /**
     * Displays a form to edit an existing huile entity.
     *
     * @Route("/modifier/500{id}500", name="huile_edit")
     *
     */
    public function editAction(Request $request, Huile $huile)
    {

        $editForm = $this->createForm('ProduitBundle\Form\HuileType', $huile);
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
    public function deleteAction(Request $request, Huile $huile)
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
}
