<?php

namespace GroupeBundle\Controller;


use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HistoriqueEtat;
use GroupeBundle\Entity\HistoriqueGroupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Site controller.
 *
 * @Route("/historique")
 */
class HIstoriqueEtatController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/signaler/{id}/5986", name="historiqueEtat_new")
     *
     */
    public function newAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $historiqueEtat = new HistoriqueEtat();
            $historiqueEtat->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateHistoriqueEtat']));
            $historiqueEtat->setStatut($_POST['statutEtat']);
            $historiqueEtat->setGroupe($groupe);


            if (isset($_POST['descriptionHistoriqueEtat']))
                $historiqueEtat->setDetail($_POST['descriptionHistoriqueEtat'])
            ;

            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setHistoriqueEtat($historiqueEtat);
            $historiqueGroupe->setDate($historiqueEtat->getDate());
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($historiqueEtat);
            $em->persist($historiqueGroupe);

            $em->flush();

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));

        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * Lists all site entities.
     *
     * @Route("/affichier{id}/5986", name="historiqueEtat_show")
     *
     */
    public function showAction(Request $request, HistoriqueEtat $historiqueEtat)
    {
        return $this->render('@Groupe/historiqueEtatGroupe/show.html.twig',array(
            'historiqueEtat' => $historiqueEtat,
        ));
    }

    /**
     * Lists all site entities.
     *
     * @Route("/modifier/500{id}/5986", name="historiqueEtat_edit")
     *
     */
    public function editAction(Request $request, HistoriqueEtat $historiqueEtat)
    {

        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $historiqueEtat->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateHistoriqueEtat']));
            $historiqueEtat->setStatut($_POST['statutEtat']);

            if (isset($_POST['dateHistoriqueEtat']))
                $historiqueEtat->setDetail($_POST['descriptionHistoriqueEtat'])
            ;

            $historiqueGroupe = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findOneBy(array(
                'historiqueEtat' => $historiqueEtat
            ));
            $historiqueGroupe->setHistoriqueEtat($historiqueEtat);
            $historiqueGroupe->setDate($historiqueEtat->getDate());

            $em->persist($historiqueEtat);
            $em->persist($historiqueGroupe);

            $em->flush();

            return $this->redirectToRoute('historiqueEtat_show', array('id' => $historiqueEtat->getId()));

        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * Lists all site entities.
     *
     * @Route("/modifier/delete/action{id}/5986", name="historiqueEtat_delete")
     *
     */
    public function deleteAction(Request $request, HistoriqueEtat $historiqueEtat)
    {
        $em = $this->getDoctrine()->getManager();

        $historiqueGroupe = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findOneBy(array(
            'historiqueEtat' => $historiqueEtat
        ));

        $groupe = $historiqueEtat->getGroupe();

        $em->remove($historiqueEtat);
        $em->remove($historiqueGroupe);

        $em->flush();

        return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));
    }

}
