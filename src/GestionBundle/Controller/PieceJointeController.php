<?php

namespace GestionBundle\Controller;


use AppBundle\Services\UploadService;
use GestionBundle\Entity\PieceJointe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PieceJointeController extends Controller
{
    /**
     * nouveau entity.
     *
     * @Route("/piece-jointe/ajouter", name="pjGestion_ajouter")
     */
    public function creerAction(Request $request)
    {
        if($request->getMethod() == 'POST'){

            $em = $this->getDoctrine()->getManager();

            $lienRedicect = '';

            $typeDoc = $_POST['typeDoc'];
            $idDoc = $_POST['idDoc'];

            $pjGestion = new PieceJointe();
            $pjGestion->setNom($_POST['pjGestion_libelle']);
            $pjGestion->setUserCreer($this->getUser());

            if($_FILES['pjGestion_fichier']['size'] > 0){

                $uploadService = new UploadService();

                if($pj = $uploadService->uploadSimpleFichier('pjGestion', 'pieceJointe', 'pjGestion_fichier')){
                    $pjGestion->setUrl($pj);
                }else{
                    throw new Exception('Erreur! Erreur dans le téléchargement du fichier..');
                }
            }

            if ($typeDoc == 'entre'){
                $entre = $em->getRepository('GestionBundle:Entre')->findOneBy(array(
                    'id' => $idDoc
                ));
                $pjGestion->setEntre($entre);

                $lienRedicect = $this->generateUrl('entre_affcher', array('id' => $idDoc));
            }

            if ($typeDoc == 'sortie'){
                $sortie = $em->getRepository('GestionBundle:Sortie')->findOneBy(array(
                    'id' => $idDoc
                ));
                $pjGestion->setSortie($sortie);

                $lienRedicect = $this->generateUrl('sortie_afficher', array('id' => $idDoc));
            }


            if ($typeDoc == 'deplacement'){
                $lienRedicect = $this->generateUrl('deplacement_affcher', array('id' => $idDoc));
                $deplacement = $em->getRepository('GestionBundle:Deplacement')->findOneBy(array(
                    'id' => $idDoc
                ));
                $pjGestion->setDeplacement($deplacement);

            }


            if ($typeDoc == 'commande'){
                $commande = $em->getRepository('GestionBundle:Commande')->findOneBy(array(
                    'id' => $idDoc
                ));
                $pjGestion->setCommande($commande);

                $lienRedicect = $this->generateUrl('commande_afficher', array('id' => $idDoc));
            }

            if ($typeDoc == 'expedition'){
                $bonExpedition = $em->getRepository('GestionBundle:BonExpedition')->findOneBy(array(
                    'id' => $idDoc
                ));
                $pjGestion->setBonExpedition($bonExpedition);

                $lienRedicect = $this->generateUrl('bonExpedition_show', array('id' => $idDoc));
            }

            $em->persist($pjGestion);
            $em->flush();

            return $this->redirect($lienRedicect);
        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * nouveau entity.
     *
     * @Route("/piece-jointe/supprimer/{id}", name="pjGestion_supprimer")
     */
    public function supprimerAction(PieceJointe $pieceJointe){

        $lienRedirect = '';
        if($pieceJointe->getEntre()){
            $lienRedirect = $this->generateUrl('entre_affcher', array('id' => $pieceJointe->getEntre()->getId()));
        }

        if($pieceJointe->getSortie()){
            $lienRedirect = $this->generateUrl('sortie_afficher', array('id' => $pieceJointe->getSortie()->getId()));
        }

        if($pieceJointe->getDeplacement()){
            $lienRedirect = $this->generateUrl('deplacement_affcher', array('id' => $pieceJointe->getDeplacement()->getId()));
        }

        if($pieceJointe->getCommande()){
            $lienRedirect = $this->generateUrl('commande_afficher', array('id' => $pieceJointe->getCommande()->getId()));
        }

        if($pieceJointe->getBonExpedition()){
            $lienRedirect = $this->generateUrl('bonExpedition_show', array('id' => $pieceJointe->getBonExpedition()->getId()));
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($pieceJointe);

        $em->flush();

        return $this->redirect($lienRedirect);

    }


}
