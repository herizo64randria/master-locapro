<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\ListePiece;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
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
        $em = $this->getDoctrine()->getManager();
        $listePieces=$em->getRepository("GroupeBundle:ListePiece")->findAll();
        $produits= $em->getRepository('ProduitBundle:Produit')->findAll();
        if ($request->getMethod()=="POST") {
            $listePiece = new Listepiece();
            $produit=$em->getRepository('ProduitBundle:Produit')->findOneBy(array('id'=>$_POST['ref']));
            $em = $this->getDoctrine()->getManager();
            $listePiece->setNom($_POST['nom']);
            $listePiece->setProduit($produit);
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

            'produits'=>$produits,
            'listepieces'=>$listePieces,

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
        $em=$this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($listePiece);
        $groupes= $em->getRepository("GroupeBundle:Groupe")->findAll();
        $produits=$em->getRepository("ProduitBundle:Produit")->findAll();
        return $this->render('@Groupe/listepiece/show.html.twig', array(
            'listePiece' => $listePiece,
            'delete_form' => $deleteForm->createView(),
            'groupes'=>$groupes,
            'produits'=>$produits,
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
        $em=$this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($listePiece);
        $editForm = $this->createForm('GroupeBundle\Form\ListePieceType', $listePiece);
        $editForm->handleRequest($request);
        $groupes= $em->getRepository("GroupeBundle:Groupe")->findAll();
        $produits=$em->getRepository("ProduitBundle:Produit")->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if(isset($_POST['groupe'])&& !empty($_POST['groupe'])){

                foreach ($_POST['groupe'] as $val){

                    $groupe= $em->getRepository("GroupeBundle:Groupe")->findOneBy(array('id'=>$val));
                    $groupe->addListepiece($listePiece);
                    // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

                    $historiqueGlobal = new HistoriqueGlobal();
                    $historiqueGlobal->setUserHistorique($this->getUser());
                    $historiqueGlobal->setLibelle('Groupe '.$groupe->getMarque().'-'.$groupe->getNumero().'compatible au pièce '.$listePiece->getNom().' ajouté');
                    $historiqueGlobal->setLien($this->generateUrl('listepiece_show', array('id' => $listePiece->getId())));

                    $em->persist($historiqueGlobal);


                    // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
                    $em->flush();

                }
               
            }
            if(isset($_POST['produit'])&& !empty($_POST['produit'])){

                foreach ($_POST['produit'] as $val){

                    $produit= $em->getRepository("ProduitBundle:Produit")->findOneBy(array('id'=>$val));

                    $produit->setReflistepiece($listePiece);
                    // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

                    $historiqueGlobal = new HistoriqueGlobal();
                    $historiqueGlobal->setUserHistorique($this->getUser());
                    $historiqueGlobal->setLibelle('Référence équivalence'.$produit->getReference().' du pièce '.$listePiece->getNom().' ajouté');
                    $historiqueGlobal->setLien($this->generateUrl('listepiece_show', array('id' => $listePiece->getId())));

                    $em->persist($historiqueGlobal);


                    // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
                    $em->flush();

                }

            }
            else
            {
                // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

                $historiqueGlobal = new HistoriqueGlobal();
                $historiqueGlobal->setUserHistorique($this->getUser());
                $historiqueGlobal->setLibelle('Information du pièce '.$listePiece->getNom().' modifié');
                $historiqueGlobal->setLien($this->generateUrl('listepiece_show', array('id' => $listePiece->getId())));

                $em->persist($historiqueGlobal);


                // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            }


            return $this->redirectToRoute('listepiece_index');
        }

        return $this->render('@Groupe/listepiece/edit.html.twig', array(
            'listePiece' => $listePiece,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'groupes'=>$groupes,
            'produits'=>$produits,
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
    /**
     * Deletes  entity.
     *
     * @Route("ty/{id}", name="compatible_delete")
     *
     */
<<<<<<< HEAD
    public function compatbleAction(Request $request,ListePiece $listePiece)
=======
    public function compatbleAction(Request $request, ListePiece $listePiece)
>>>>>>> master
    {
        $em=$this->getDoctrine()->getManager();
        $groupe=$em->getRepository("GroupeBundle:Groupe")->findOneBy(array('id'=>$_GET['idGroupe']));
        $groupe->removeListepiece($listePiece);
        $em->flush();
        return $this->redirectToRoute('listepiece_edit',array('id'=>$listePiece->getId()));
    }
    /**
     * Deletes  entity.
     *
     * @Route("ref/{id}", name="ref_delete")
     *
     */
    public function refAction(Request $request,Produit $produit)
    {
        $em=$this->getDoctrine()->getManager();
        $produit->setReflistepiece(null);
        $em->flush();
        return $this->redirectToRoute('listepiece_edit',array('id'=>$_GET['idListPiece']));
    }
}
