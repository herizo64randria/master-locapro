<?php

namespace GroupeBundle\Controller;


use GroupeBundle\Entity\Depense;
use GroupeBundle\Entity\EmployeMission;
use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HistoriqueGroupe;
use GroupeBundle\Entity\Mission;
use GroupeBundle\Entity\Probleme;
use GroupeBundle\Entity\Vidange;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Site controller.
 *
 * @Route("/depense")
 */
class DepenseHissabController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/ajouter/d{id}", name="depense_new")
     *
     */
    public function newAction(Request $request, Probleme $probleme)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){
            $depense = new Depense();
            $depense->setProbleme($probleme);
            $depense->setGroupe($probleme->getGroupe());
            $depense->setIdDepense($_POST['depense']);
            $depense->setLien($_POST['lien']);
            $depense->setNumero($_POST['numero']);
            $depense->setMontant($_POST['montant']);

            $em->persist($depense);
            $em->flush();

            return $this->redirectToRoute('probleme_show', array('id' => $probleme->getId()));
        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * Lists all site entities.
     *
     * @Route("/supprimer/depense/500{id}", name="depense_delete")
     *
     */
    public function deleteAction(Request $request, Depense $depense)
    {
        $em = $this->getDoctrine()->getManager();

        $probleme = $depense->getProbleme();

        $em->remove($depense);
        $em->flush();

        return $this->redirectToRoute('probleme_show', array('id' => $probleme->getId()));

    }



}
