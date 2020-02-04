<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Site controller.
 *
 * @Route("/site")
 */
class SiteController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/", name="site_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sites = $em->getRepository('GroupeBundle:Site')->findBy(
            array(),
            array('emplacement' => 'asc'))
        ;

        return $this->render('@Groupe/site/index.html.twig', array(
            'sites' => $sites,
        ));
    }

    /**
     * Creates a new site entity.
     *
     * @Route("/nouveau", name="site_new")
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sites = $em->getRepository('GroupeBundle:Site')->findAll();

        if ($request->getMethod() == "POST") {
            $site = new Site();
            $site->setEmplacement($_POST['emplacement']);

            $site->setCouleur($_POST['couleur']);

            $coords = array(
                'x' => $_POST['coordsX'],
                'y' => $_POST['coordsY'],
            );

            $site->setCoords($coords);

            $em->persist($site);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Nouveau site créé: '.$site->getEmplacement());
            $historiqueGlobal->setLien($this->generateUrl('site_index'));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('site_index');
        }

        return $this->render('@Groupe/site/new.html.twig', array(
            'sites' => $sites,
        ));
    }

    /**
     * Finds and displays a site entity.
     *
     * @Route("/{id}/sh/ow", name="site_show")
     *
     */
    public function showAction(Site $site)
    {
        $deleteForm = $this->createDeleteForm($site);

        return $this->render('site/show.html.twig', array(
            'site' => $site,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing site entity.
     *
     * @Route("/{id}/modifier", name="site_edit")
     *
     */
    public function editAction(Request $request, Site $site)
    {

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $site->setEmplacement($_POST['emplacement']);

            $site->setCouleur($_POST['couleur']);

            $coords = array(
                'x' => $_POST['coordsX'],
                'y' => $_POST['coordsY'],
            );

            $site->setCoords($coords);

            $em->persist($site);
            $em->flush();

            // ------------------- HISTORIQUE GLOBAL ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information sur le site: '.$site->getEmplacement().' modifié');
            $historiqueGlobal->setLien($this->generateUrl('site_index'));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('site_index');
        }

        return $this->render('@Groupe/site/edit.html.twig', array(
            'site' => $site,
        ));
    }

    /**
     * Deletes a site entity.
     *
     * @Route("/{id}", name="site_delete")
     *
     */
    public function deleteAction(Request $request, Site $site)
    {
        $form = $this->createDeleteForm($site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($site);
            $em->flush();
        }

        return $this->redirectToRoute('site_index');
    }

    /**
     * Creates a form to delete a site entity.
     *
     * @param Site $site The site entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Site $site)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('site_delete', array('id' => $site->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
