<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Catalogue;
use GroupeBundle\Entity\PjCatalogue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Services\UploadService;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Catalogue controller.
 *
 * @Route("catalogue")
 */
class CatalogueController extends Controller
{
    /**
     * Lists all catalogue entities.
     *
     * @Route("/nouveau/catalogue", name="catalogue_new")
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){
            $catalogue = new Catalogue();
            $catalogue->setTitre($_POST['titre']);


            $em->persist($catalogue);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Ajout d\'un nouveau catalogue'.$catalogue->getTitre());
            $historiqueGlobal->setLien($this->generateUrl('catalogue_show', array('id' => $catalogue->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('catalogue_edit', array('id' =>  $catalogue->getId()));
        }

        throw new Exception('Erreur 404');
    }


    /**
     * Lists all catalogue entities.
     *
     * @Route("/", name="catalogue_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $catalogues = $em->getRepository('GroupeBundle:Catalogue')->findAll();

        return $this->render('@Groupe/catalogue/index.html.twig', array(
            'catalogues' => $catalogues,
        ));
    }

    /**
     * Finds and displays a catalogue entity M.
     *
     * @Route("/{id}ID500/information", name="catalogue_show")
     *
     */
    public function showAction(Catalogue $catalogue)
    {
        $em = $this->getDoctrine()->getManager();
        $pjcatalogues = $em->getRepository('GroupeBundle:PjCatalogue')->findBy(array('catalogue'=>$catalogue));

        return $this->render('@Groupe/catalogue/show.html.twig', array(
            'catalogue' => $catalogue,'pjcatalogues' => $pjcatalogues,
        ));
    }
    /**
     * Finds and displays a catalogue entity M.
     *
     * @Route("/{id}ID556/modifier-piece-jointe-catalogue", name="pjcatalogue_modifier")
     *
     */
    public function editPJAction(PjCatalogue $pjcatalogue,Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod()=="POST")
        {
            $upload=new UploadService();
            if($pjcatalogue->getNom() != $_POST['nompj'])
            {   $pjcatalogue->setNom($_POST['nompj']);
                $em->persist($pjcatalogue);
                $em->flush();
            }
            if($_FILES['file'])
            {
                if($file=$upload->uploadSimpleFichier('catalogue','catalogue','file'))
                {
                    $pjcatalogue->setLien($file);
                    $pjcatalogue->setNom($_POST['nompj']);
                    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    $pjcatalogue->setExt(strtolower($ext));
                    $em->merge($pjcatalogue);

                    // ------------------- HISTORIQUE GLOBAL ---------------------

                    $historiqueGlobal = new HistoriqueGlobal();
                    $historiqueGlobal->setUserHistorique($this->getUser());
                    $historiqueGlobal->setLibelle('Ajout d\'un nouveau catalogue'.$pjcatalogue->getNom());
                    $historiqueGlobal->setLien($this->generateUrl('catalogue_show', array('id' => $pjcatalogue->getCatalogue()->getId())));

                    $em->persist($historiqueGlobal);


                    // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
                    $em->flush();
                }
            }

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information du pièce jointe catalogue'.$pjcatalogue->getNom().modifié);
            $historiqueGlobal->setLien($this->generateUrl('catalogue_show', array('id' => $pjcatalogue->getCatalogue()->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            return $this->redirectToRoute('catalogue_show',array('id'=>$pjcatalogue->getCatalogue()->getId()));

        }
        return $this->render('@Groupe/catalogue/editPiecejointeCatalogue.html.twig', array(
            'pjcatalogue' => $pjcatalogue,
        ));
    }

    /**
     * Finds and displays a catalogue entity M.
     *
     * @Route("/modifier/{id}ID500/inf", name="catalogue_edit")
     *
     */
    public function editAction(Catalogue $catalogue, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pjcatalogues = $em->getRepository('GroupeBundle:PjCatalogue')->findBy(array('catalogue'=>$catalogue));
        if($request->getMethod() == 'POST'){
            $catalogue->setTitre($_POST['titre']);
            $catalogue->setText($_POST['text']);
            $upload=new UploadService();

            if($_FILES['file'])
            {
                if($file=$upload->uploadSimpleFichier('catalogue','catalogue','file'))
                {
                    $pjcatalogue=new  PjCatalogue();
                    $pjcatalogue->setLien($file);
                    $pjcatalogue->setNom($_POST['nompj']);
                    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    $pjcatalogue->setExt(strtolower($ext));
                    $pjcatalogue->setCatalogue($catalogue);

                    // ------------------- HISTORIQUE GLOBAL ---------------------

                    $historiqueGlobal = new HistoriqueGlobal();
                    $historiqueGlobal->setUserHistorique($this->getUser());
                    $historiqueGlobal->setLibelle('Ajout d\'un nouveau catalogue'.$pjcatalogue->getNom());
                    $historiqueGlobal->setLien($this->generateUrl('catalogue_show', array('id' => $pjcatalogue->getCatalogue()->getId())));

                    $em->persist($historiqueGlobal);


                    // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
                    $em->persist($pjcatalogue);

                }

            }

            $em->flush();
            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information du catalogue'.$catalogue->getTitre().modifié);
            $historiqueGlobal->setLien($this->generateUrl('catalogue_show', array('id' => $catalogue->getCatalogue()->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            return $this->redirectToRoute('catalogue_show', array('id' => $catalogue->getId()));
        }

        return $this->render('@Groupe/catalogue/edit.html.twig', array(
            'catalogue' => $catalogue,'pjcatalogues'=>$pjcatalogues
        ));
    }

    /**
     * Finds and displays a catalogue entity M.
     *
     * @Route("/{id}ID546/supprimer-piece-jointe-catalogue", name="pjcatalogue_supprimer")
     *
     */
    public function deletePJAction(PjCatalogue $pjcatalogue,Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($pjcatalogue);

        // ------------------- HISTORIQUE GLOBAL ---------------------

        $historiqueGlobal = new HistoriqueGlobal();
        $historiqueGlobal->setUserHistorique($this->getUser());
        $historiqueGlobal->setLibelle('Supprimer le piece joint catalogue'.$pjcatalogue->getNom());
        $historiqueGlobal->setLien($this->generateUrl('catalogue_show', array('id' => $pjcatalogue->getCatalogue()->getId())));

        $em->persist($historiqueGlobal);


        // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
        $em->flush();
        return $this->redirectToRoute('catalogue_show',array('id'=>$pjcatalogue->getCatalogue()->getId()));


    }
}
