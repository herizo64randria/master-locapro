<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HistoriqueGroupe;
use GroupeBundle\Entity\SuiviPiece;
use ProduitBundle\Entity\HistoriqueProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\HistoriqueGlobal;

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

            $quantitePiece = (int)$_POST['suivi_quantite'];

            if ($quantitePiece < 1 )
                return new Response('Erreur dans la quantité saisie');

            $suivi->setQuantite($quantitePiece);

            $typePiece = $em->getRepository('GroupeBundle:ListePiece')->findOneBy(
                array('id' => $_POST['typePiece'])
            );

            if($typePiece == null)
                return new Response('Type de piece non-reconnue');

            $suivi->setTypePiece($typePiece);

            if (isset($_POST['descriptionSuivi']))
                $suivi->setDescription($_POST['descriptionSuivi']);

            // ------------------ SORTIE EN STOCK PIECE ------------------

            if(isset($_POST['chk_sortieEnStockSuivi'])){
                $suivi->setSortieEnStock(true);

                $suivi_produit = $em->getRepository('ProduitBundle:Produit')->findOneBy(array(
                        'id' => $_POST['suivi_produit']
                    )
                );

                if(!$suivi_produit)
                    throw new Exception('Produit non-trouvé');

                $repositoryStock = $this->getDoctrine()->getRepository('ProduitBundle:Stock_');
                $stkProduit = $repositoryStock->findOneBy(array(
                    'produit' => $suivi_produit,
                    'site' => $groupe->getSite()
                ));

                if($stkProduit->getQuantite() < 1 or $stkProduit->getQuantite() < $quantitePiece)
                    return new Response('Quantité produit insuffisante');

                $stkProduit->setQuantite($stkProduit->getQuantite() - $quantitePiece);
                $em->persist($stkProduit);

                // ------------------ HISTORIQUE PRODUIT ------------------

                $historiqueProduit = new HistoriqueProduit();

                $historiqueProduit->setType('debit');
                $historiqueProduit->setProduit($suivi_produit);
                $historiqueProduit->setRemplacementPiece($suivi);
                $historiqueProduit->setDate($suivi->getDate());
                $historiqueProduit->setQuantite($quantitePiece);
                $historiqueProduit->setSite($groupe->getSite());

                $em->persist($historiqueProduit);

                // ------------------///// HISTORIQUE PRODUIT /////------------------

            }

            // ------------------///// SORTIE EN STOCK PIECE /////------------------

            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($suivi->getDate());
            $historiqueGroupe->setSuiviPiece($suivi);
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($suivi);
            $em->persist($historiqueGroupe);

            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

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
            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information suivi du pièce: '. $suivi->getLibelle().'modifié');
            $historiqueGlobal->setLien($this->generateUrl('suivi_piece_show',array('id'=>$suivi->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

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
        // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
        $historiqueGlobal = new HistoriqueGlobal();
        $historiqueGlobal->setUserHistorique($this->getUser());
        $historiqueGlobal->setLibelle('Information suivi du pièce: '. $suivi->getLibelle().'supprimé');

        $em->persist($historiqueGlobal);
        $em->flush();

        // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

        return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));
    }








}
