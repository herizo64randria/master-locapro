<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\DeplacementGroupe;
use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HistoriqueGroupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Site controller.
 *
 * @Route("/site/groupe")
 */
class DeplacementGroupeController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/deplacer/{id}/5986", name="groupe_deplacement_site")
     *
     */
    public function deplacementGroupeAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){
            $siteDepart = $groupe->getSite();

            $siteDestination = $em->getRepository('GroupeBundle:Site')->findOneBy(
                array('id' => $_POST['siteDestination'])
            );

            $deplacement = new DeplacementGroupe();
            $deplacement->setSiteDepart($siteDepart);
            $deplacement->setSiteDestination($siteDestination);
            $deplacement->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateDeplacement']));
            if (isset($_POST['description']))
                $deplacement->setDescription($_POST['description']);


            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($deplacement->getDate());
            $historiqueGroupe->setDeplacement($deplacement);
            $historiqueGroupe->setGroupe($groupe);

            $groupe->setSite($siteDestination);

            $em->persist($deplacement);
            $em->persist($historiqueGroupe);
            $em->persist($groupe);

            $em->flush();

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));


        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * Lists all site entities.
     *
     * @Route("/detail/deplacement/{id}/5986", name="groupe_deplacement_show")
     *
     */
    public function deplacementDetailAction(Request $request, DeplacementGroupe $deplacement)
    {
        $em = $this->getDoctrine()->getManager();

        $historiqueGroupe = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findOneBy(
            array('deplacement' => $deplacement)
        );

        $sites = $em->getRepository('GroupeBundle:Site')->findBy(
            array(),
            array('emplacement' => 'asc'))
        ;

        $groupe = $historiqueGroupe->getGroupe();

        return $this->render('@Groupe/deplacement/show.html.twig', array(
            'groupe' => $groupe,
            'deplacement' => $deplacement,
            'sites' => $sites,
        ));
    }

    /**
     * Lists all site entities.
     *
     * @Route("/m{id}/400/modifier", name="groupe_deplacement_edit")
     *
     */
    public function deplacementModifierAction(Request $request, DeplacementGroupe $deplacement)
    {
        $em = $this->getDoctrine()->getManager();

        $historiqueGroupe = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findOneBy(
            array('deplacement' => $deplacement)
        );

        $groupe = $historiqueGroupe->getGroupe();


        $siteDestination = $em->getRepository('GroupeBundle:Site')->findOneBy(
            array('id' => $_POST['siteDestination'])
        );


        $deplacement->setSiteDestination($siteDestination);
        $deplacement->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateDeplacement']));
        if (isset($_POST['description']))
            $deplacement->setDescription($_POST['description']);


        $historiqueGroupe->setDate($deplacement->getDate());

        $groupe->setSite($deplacement->getSiteDestination());

        $em->persist($deplacement);
        $em->persist($historiqueGroupe);
        $em->persist($groupe);

        $em->flush();

        return $this->redirectToRoute('groupe_deplacement_show', array('id' => $deplacement->getId()));
    }


}
