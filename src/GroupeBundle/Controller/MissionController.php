<?php

namespace GroupeBundle\Controller;


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
use UserBundle\Entity\HistoriqueGlobal;

/**
 * Site controller.
 *
 * @Route("/mission/pbm")
 */
class MissionController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/créer/500{id}/check", name="mission_newProbleme")
     *
     */
    public function newAction(Request $request, Probleme $probleme)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){
            $mission = new Mission();
            $mission->setDateDebut(\DateTime::createFromFormat('d/m/Y', $_POST['dateDebutMission']));
            $mission->setDateFin(\DateTime::createFromFormat('d/m/Y', $_POST['dateFinMission']));

            if (isset($_POST['descriptionMission']))
                $mission->setDescription($_POST['descriptionMission']);

            $mission->setSite($probleme->getGroupe()->getSite());
            $mission->setProbleme($probleme);

            $em->persist($mission);
            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Ajout du mission'.$mission->getNoteFin());
            $historiqueGlobal->setLien($this->generateUrl('mission_show', array('id' => $mission->getId())));

            $em->persist($historiqueGlobal);


            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            $em->flush();

            return $this->redirectToRoute('mission_show', array('id' => $mission->getId()));
        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * Lists all site entities.
     *
     * @Route("/afficher/500{id}500", name="mission_show")
     *
     */
    public function showAction(Request $request, Mission $mission)
    {
        return $this->render('@Groupe/mission/show.html.twig', array(
            'mission' => $mission,
        ));


    }

    /**
     * Lists all site entities.
     *
     * @Route("/mi/500{id}500/ajouter-employe", name="employeMission_ajouter")
     *
     */
    public function newEmployeAction(Request $request, Mission $mission){

        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $employe = new EmployeMission();
            $employe->setNom($_POST['nomEmploye']);
            $employe->setIdEmploye($_POST['idEmploye']);
            $employe->setLien($_POST['lien']);
            $employe->setPoste($_POST['poste']);
            $employe->setMission($mission);

            $em->persist($employe);
            $em->flush();

            return $this->redirectToRoute('mission_show', array('id' => $mission->getId()));
        }

        throw new Exception('Erreur! 404 NOT-FOUND');

    }

    /**
     * Lists all site entities.
     *
     * @Route("/effacer/emp/{id}", name="employeMission_supprimer")
     *
     */
    public function deleteEmployeAction(Request $request, EmployeMission $employe){
        $em = $this->getDoctrine()->getManager();

        $mission = $employe->getMission();

        $em->remove($employe);
        $em->flush();

        return $this->redirectToRoute('mission_show', array('id' => $mission->getId()));
    }



}
