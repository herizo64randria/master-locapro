<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\PieceRefEqiv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Piecerefeqiv controller.
 *
 * @Route("reference-equivalent")
 */
class PieceRefEqivController extends Controller
{
    /**
     * Lists all pieceRefEqiv entities.
     *
     * @Route("/", name="piecerefeqiv_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pieceRefEqivs = $em->getRepository('GroupeBundle:PieceRefEqiv')->findAll();

        return $this->render('@Groupe/piecerefeqiv/index.html.twig', array(
            'pieceRefEqivs' => $pieceRefEqivs,
        ));
    }

    /**
     * Creates a new pieceRefEqiv entity.
     *
     * @Route("/new", name="piecerefeqiv_new")
     */
    public function newAction(Request $request)
    {
        $pieceRefEqiv = new Piecerefeqiv();
        $form = $this->createForm('GroupeBundle\Form\PieceRefEqivType', $pieceRefEqiv);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $listepieces=$em->getRepository("GroupeBundle:ListePiece")->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $listepiece=$em->getRepository("GroupeBundle:ListePiece")->findOneBy(array('id'=>$_POST['piece']));
            $pieceRefEqiv->setListepiece($listepiece);
            $em->persist($pieceRefEqiv);
            $em->flush();

            return $this->redirectToRoute('listepiece_index');
        }

        return $this->render('@Groupe/piecerefeqiv/new.html.twig', array(
            'pieceRefEqiv' => $pieceRefEqiv,
            'form' => $form->createView(),
            'listepieces'=>$listepieces
        ));
    }

    /**
     * Finds and displays a pieceRefEqiv entity.
     *
     * @Route("/{id}", name="piecerefeqiv_show")
     */
    public function showAction(PieceRefEqiv $pieceRefEqiv)
    {
        $deleteForm = $this->createDeleteForm($pieceRefEqiv);

        return $this->render('@Groupe/piecerefeqiv/show.html.twig', array(
            'pieceRefEqiv' => $pieceRefEqiv,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pieceRefEqiv entity.
     *
     * @Route("/{id}/edit", name="piecerefeqiv_edit")
     */
    public function editAction(Request $request, PieceRefEqiv $pieceRefEqiv)
    {
        $deleteForm = $this->createDeleteForm($pieceRefEqiv);
        $editForm = $this->createForm('GroupeBundle\Form\PieceRefEqivType', $pieceRefEqiv);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('piecerefeqiv_edit', array('id' => $pieceRefEqiv->getId()));
        }

        return $this->render('@Groupe/piecerefeqiv/edit.html.twig', array(
            'pieceRefEqiv' => $pieceRefEqiv,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pieceRefEqiv entity.
     *
     * @Route("/{id}", name="piecerefeqiv_delete")
     */
    public function deleteAction(Request $request, PieceRefEqiv $pieceRefEqiv)
    {
        $form = $this->createDeleteForm($pieceRefEqiv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pieceRefEqiv);
            $em->flush();
        }

        return $this->redirectToRoute('piecerefeqiv_index');
    }

    /**
     * Creates a form to delete a pieceRefEqiv entity.
     *
     * @param PieceRefEqiv $pieceRefEqiv The pieceRefEqiv entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PieceRefEqiv $pieceRefEqiv)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('piecerefeqiv_delete', array('id' => $pieceRefEqiv->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
