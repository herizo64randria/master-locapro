<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Depot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Depot controller.
 *
 * @Route("depot")
 */
class DepotController extends Controller
{
    /**
     * Lists all depot entities.
     *
     * @Route("/", name="depot_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $depots = $em->getRepository('ProduitBundle:Depot')->findAll();

        return $this->render('@Produit/depot/index.html.twig', array(
            'depots' => $depots,
        ));
    }

    /**
     * Creates a new depot entity.
     *
     * @Route("/créer", name="depot_new")
     */
    public function newAction(Request $request)
    {
        $depot = new Depot();
        $form = $this->createForm('ProduitBundle\Form\DepotType', $depot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($depot);
            $em->flush();

            return $this->redirectToRoute('depot_index');
        }

        return $this->render('@Produit/depot/new.html.twig', array(
            'depot' => $depot,
            'form' => $form->createView(),
        ));
    }
//
//    /**
//     * Finds and displays a depot entity.
//     *
//     * @Route("/{id}", name="depot_show")
//     */
//    public function showAction(Depot $depot)
//    {
//        $deleteForm = $this->createDeleteForm($depot);
//
//        return $this->render('depot/show.html.twig', array(
//            'depot' => $depot,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing depot entity.
     *
     * @Route("/e/{id}/modifier", name="depot_edit")
     */
    public function editAction(Request $request, Depot $depot)
    {
        $editForm = $this->createForm('ProduitBundle\Form\DepotType', $depot);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('depot_edit', array('id' => $depot->getId()));
        }

        return $this->render('@Produit/depot/edit.html.twig', array(
            'depot' => $depot,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a depot entity.
     *
     * @Route("/{id}/supprimer", name="depot_delete")
     */
    public function deleteAction(Depot $depot)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($depot);

        $em->flush();

        return $this->redirectToRoute('depot_index');
    }


}
