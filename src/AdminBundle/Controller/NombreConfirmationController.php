<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\NombreConfirmation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Nombreconfirmation controller.
 *
 * @Route("nombreconfirmation")
 */
class NombreConfirmationController extends Controller
{
    /**
     * Lists all nombreConfirmation entities.
     *
     * @Route("/", name="nombreconfirmation_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nombreConfirmations = $em->getRepository('AdminBundle:NombreConfirmation')->findAll();

        return $this->render('@Admin/nombreconfirmation/index.html.twig', array(
            'nombreConfirmations' => $nombreConfirmations,
        ));
    }



    /**
     * Displays a form to edit an existing nombreConfirmation entity.
     *
     * @Route("/{id}/modifier", name="nombreconfirmation_edit")
     */
    public function editAction(Request $request, NombreConfirmation $nombreConfirmation)
    {
        $deleteForm = $this->createDeleteForm($nombreConfirmation);
        $editForm = $this->createForm('AdminBundle\Form\NombreConfirmationType', $nombreConfirmation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nombreconfirmation_index');
        }

        return $this->render('@Admin/nombreconfirmation/edit.html.twig', array(
            'nombreConfirmation' => $nombreConfirmation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nombreConfirmation entity.
     *
     * @Route("/{id}", name="nombreconfirmation_delete")
     */
    public function deleteAction(Request $request, NombreConfirmation $nombreConfirmation)
    {
        $form = $this->createDeleteForm($nombreConfirmation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nombreConfirmation);
            $em->flush();
        }

        return $this->redirectToRoute('nombreconfirmation_index');
    }

    /**
     * Creates a form to delete a nombreConfirmation entity.
     *
     * @param NombreConfirmation $nombreConfirmation The nombreConfirmation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NombreConfirmation $nombreConfirmation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nombreconfirmation_delete', array('id' => $nombreConfirmation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
