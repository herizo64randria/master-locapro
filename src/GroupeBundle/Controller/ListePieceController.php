<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\ListePiece;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Listepiece controller.
 *
 * @Route("listepiece")
 */
class ListePieceController extends Controller
{
    /**
     * Lists all listePiece entities.
     *
     * @Route("/", name="listepiece_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listePieces = $em->getRepository('GroupeBundle:ListePiece')->findAll();

        return $this->render('@Groupe/listepiece/index.html.twig', array(
            'listePieces' => $listePieces,
        ));
    }

    /**
     * Creates a new listePiece entity.
     *
     * @Route("/nouveau/", name="listepiece_new")
     *
     */
    public function newAction(Request $request)
    {
        $listePiece = new Listepiece();
        $form = $this->createForm('GroupeBundle\Form\ListePieceType', $listePiece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($listePiece);
            $em->flush();
            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Ajout d\'un nouveau piece'.$listePiece->getNom());
            $historiqueGlobal->setLien($this->generateUrl('listepiece_show', array('id' => $listePiece->getId())));

            $em->persist($historiqueGlobal);


            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            return $this->redirectToRoute('listepiece_index');
        }

        return $this->render('@Groupe/listepiece/new.html.twig', array(
            'listePiece' => $listePiece,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a listePiece entity.
     *
     * @Route("/{id}", name="listepiece_show")
     *
     */
    public function showAction(ListePiece $listePiece)
    {
        $deleteForm = $this->createDeleteForm($listePiece);

        return $this->render('listepiece/show.html.twig', array(
            'listePiece' => $listePiece,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing listePiece entity.
     *
     * @Route("/{id}/edit", name="listepiece_edit")
     *
     */
    public function editAction(Request $request, ListePiece $listePiece)
    {
        $deleteForm = $this->createDeleteForm($listePiece);
        $editForm = $this->createForm('GroupeBundle\Form\ListePieceType', $listePiece);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $em = $this->getDoctrine()->getManager();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information du pièce'.$listePiece->getNom().' modifié');
            $historiqueGlobal->setLien($this->generateUrl('listepiece_show', array('id' => $listePiece->getId())));

            $em->persist($historiqueGlobal);


            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            return $this->redirectToRoute('listepiece_index');
        }

        return $this->render('@Groupe/listepiece/edit.html.twig', array(
            'listePiece' => $listePiece,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a listePiece entity.
     *
     * @Route("/{id}", name="listepiece_delete")
     *
     */
    public function deleteAction(Request $request, ListePiece $listePiece)
    {
        $form = $this->createDeleteForm($listePiece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($listePiece);

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Supprimer pièce'.$listePiece->getNom());

            $em->persist($historiqueGlobal);


            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            $em->flush();
        }

        return $this->redirectToRoute('listepiece_index');
    }

    /**
     * Creates a form to delete a listePiece entity.
     *
     * @param ListePiece $listePiece The listePiece entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ListePiece $listePiece)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('listepiece_delete', array('id' => $listePiece->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
