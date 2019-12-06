<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HistoriqueGroupe;
use GroupeBundle\Entity\SuiviPiece;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Site controller.
 *
 * @Route("/site/groupe/suivi-piece")
 */
class SuiviPieceController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/{id}/nouveau", name="suivi_piece_new")
     *
     */
    public function newAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $suivi = new SuiviPiece();
            $suivi->setLibelle($_POST['libelleSuivi']);
            $suivi->setGroupe($groupe);
            $suivi->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateSuivi']));

            $typePiece = $em->getRepository('GroupeBundle:ListePiece')->findOneBy(
                array('id' => $_POST['typePiece'])
            );

            $suivi->setTypePiece($typePiece);

            if (isset($_POST['descriptionSuivi']))
                $suivi->setDescription($_POST['descriptionSuivi'])
            ;

            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($suivi->getDate());
            $historiqueGroupe->setSuiviPiece($suivi);
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($suivi);
            $em->persist($historiqueGroupe);

            $em->flush();

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));


        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * Lists all site entities.
     *
     * @Route("/{id}/detail-technique", name="suivi_piece_show")
     *
     */
    public function showAction(Request $request, SuiviPiece $suivi)
    {
        $em = $this->getDoctrine()->getManager();


        $listePieces = $em->getRepository('GroupeBundle:ListePiece')->findBy(
            array(),
            array('nom' => 'asc')
        );

        return $this->render('@Groupe/suiviPiece/show.html.twig',array(
            'suivi' => $suivi,
            'listePieces' => $listePieces,
        ));

    }

    /**
     * Lists all site entities.
     *
     * @Route("/modifier/500/{id}/detail-technique", name="suivi_piece_edit")
     *
     */
    public function editAction(Request $request, SuiviPiece $suivi)
    {
        $em = $this->getDoctrine()->getManager();
        $groupe = $suivi->getGroupe();

        if($request->getMethod() == 'POST'){
            $suivi->setLibelle($_POST['libelleSuivi']);
            $suivi->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateSuivi']));

            $typePiece = $em->getRepository('GroupeBundle:ListePiece')->findOneBy(
                array('id' => $_POST['typePiece'])
            );

            $suivi->setTypePiece($typePiece);

            if (isset($_POST['descriptionSuivi']))
                $suivi->setDescription($_POST['descriptionSuivi'])
            ;

            $historiqueGroupe = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findOneBy(array(
                'suiviPiece' => $suivi
            ));
            $historiqueGroupe->setDate($suivi->getDate());

            $em->persist($suivi);
            $em->persist($historiqueGroupe);

            $em->flush();

            return $this->redirectToRoute('suivi_piece_show', array('id' => $suivi->getId()));
        }

        throw new Exception('Erreur! 404 NOT-FOUND');

    }

    /**
     * Lists all site entities.
     *
     * @Route("/suprimer/{id}/detail-technique", name="suivi_piece_delete")
     *
     */
    public function deleteAction(Request $request, SuiviPiece $suivi)
    {
        $em = $this->getDoctrine()->getManager();

        $historiqueGroupe = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findOneBy(array(
            'suiviPiece' => $suivi
        ));

        $groupe = $suivi->getGroupe();

        $em->remove($suivi);
        $em->remove($historiqueGroupe);

        $em->flush();

        return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));
    }








}
