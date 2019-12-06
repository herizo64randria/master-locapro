<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\FamilleProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Familleproduit controller.
 *
 * @Route("famille-produit")
 */
class FamilleProduitController extends Controller
{
    /**
     * Lists all familleProduit entities.
     *
     * @Route("/", name="famille-produit_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $familleProduits = $em->getRepository('ProduitBundle:FamilleProduit')->findAll();

        return $this->render('@Produit/familleproduit/index.html.twig', array(
            'familleProduits' => $familleProduits,
        ));
    }

    /**
     * Creates a new familleProduit entity.
     *
     * @Route("/nouveau", name="famille-produit_new")
     */
    public function newAction(Request $request)
    {
        $familleProduit = new Familleproduit();
        $form = $this->createForm('ProduitBundle\Form\FamilleProduitType', $familleProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($familleProduit);
            $em->flush();

            return $this->redirectToRoute('famille-produit_show', array('id' => $familleProduit->getId()));
        }

        return $this->render('familleproduit/new.html.twig', array(
            'familleProduit' => $familleProduit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a familleProduit entity.
     *
     * @Route("/{id}", name="famille-produit_show")
     */
    public function showAction(FamilleProduit $familleProduit)
    {
        $deleteForm = $this->createDeleteForm($familleProduit);

        return $this->render('familleproduit/show.html.twig', array(
            'familleProduit' => $familleProduit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing familleProduit entity.
     *
     * @Route("/{id}/edit", name="famille-produit_edit")
     */
    public function editAction(Request $request, FamilleProduit $familleProduit)
    {
        $deleteForm = $this->createDeleteForm($familleProduit);
        $editForm = $this->createForm('ProduitBundle\Form\FamilleProduitType', $familleProduit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('famille-produit_edit', array('id' => $familleProduit->getId()));
        }

        return $this->render('familleproduit/edit.html.twig', array(
            'familleProduit' => $familleProduit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a familleProduit entity.
     *
     * @Route("/{id}", name="famille-produit_delete")
     */
    public function deleteAction(Request $request, FamilleProduit $familleProduit)
    {
        $form = $this->createDeleteForm($familleProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($familleProduit);
            $em->flush();
        }

        return $this->redirectToRoute('famille-produit_index');
    }

    /**
     * Creates a form to delete a familleProduit entity.
     *
     * @param FamilleProduit $familleProduit The familleProduit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FamilleProduit $familleProduit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('famille-produit_delete', array('id' => $familleProduit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
