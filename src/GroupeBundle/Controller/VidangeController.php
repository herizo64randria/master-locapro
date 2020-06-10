<?php

namespace GroupeBundle\Controller;


use AppBundle\Services\ProduitService;
use GroupeBundle\Entity\Groupe;
use GroupeBundle\Entity\HistoriqueGroupe;
use GroupeBundle\Entity\SuiviPiece;
use GroupeBundle\Entity\Vidange;
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
 * @Route("/vidange/groupe")
 */
class VidangeController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/deplacer/{id}/5986", name="vidange_new")
     *
     */
    public function newAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $vidange = new Vidange();
            $vidange->setGroupe($groupe);
            $vidange->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateVidange']));
            $vidange->setType($_POST['typeVidange']);
            $vidange->setHeureMarche($_POST['heureMarche']);

            if (isset($_POST['descriptionVidange']))
                $vidange->setDescription($_POST['descriptionVidange'])
            ;

            $qttUtilise = 0;
            if (isset($_POST['huileUtilise'])){
                $qttUtilise = $_POST['huileUtilise'];

            }

            $vidange->setHuileUtilise($qttUtilise);

            $huile = null;

            if(isset($_POST['chkHuileVidange'])){
                // ------------------- HUILE UTILISE ---------------------

                if (isset($_POST['huileUtilise'])){
                    if ($qttUtilise < 0)
                        throw new Exception('Erreur! Valeur de huile utilisé négatif');

                    // ------------------- STOCK HUILE ---------------------

                    $stockHuile = 0;
                    $huile = $em->getRepository('ProduitBundle:Produit')->findOneBy(array(
                        'huileParDefaut' => true,
                        'siHuile' => true
                    ));

                    if (!$huile){
                        throw new Exception('Erreur! Huile par défaut non-défini.');
                    }

                    $repositoryStock = $em->getRepository('ProduitBundle:Stock_');
                    $stcHuile = $repositoryStock->findOneBy(array(
                        'produit' => $huile,
                        'site' => $groupe->getSite()
                    ));

                    if ($stcHuile){
                        $stockHuile = $stcHuile->getQuantite();
                    }

                    if ($stockHuile < $qttUtilise){
                        throw new Exception('Erreur! Stock d\'huile insufisante');
                    }

                    $huileRestant = $stockHuile - $qttUtilise;
                    $stcHuile->setQuantite($huileRestant);
                    $em->persist($stcHuile);

                    // ------------------- ////// STOCK HUILE ////// ---------------------

                    //--------HISTORIQUE DU PRODUIT------------
                    $historiqueProduit = new HistoriqueProduit();

                    $historiqueProduit->setType('debit');
                    $historiqueProduit->setProduit($huile);
                    $historiqueProduit->setVidange($vidange);
                    $historiqueProduit->setDate($vidange->getDate());
                    $historiqueProduit->setQuantite($qttUtilise);
                    $historiqueProduit->setSite($groupe->getSite());

                    $em->persist($historiqueProduit);
                }
                // ------------------- ////// HUILE UTILISE ////// ---------------------
            }



            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setVidange($vidange);
            $historiqueGroupe->setDate($vidange->getDate());
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($vidange);
            $em->persist($historiqueGroupe);
            $em->flush();

            // ------------------- Mis A Jour du stock d'huile ---------------------
            if ($huile){
                $serviceProduit = new ProduitService($em);
                $serviceProduit->updateStockTotal($huile);
            }

            // ------------------- ////// Mis A Jour du stock d'huile ////// ---------------------

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle("Vidange du groupe: {$groupe->getNumero()} - Type {$vidange->getType()}");
            $historiqueGlobal->setLien($this->generateUrl('vidange_show',array('id'=>$vidange->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));

        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }

    /**
     * Lists all site entities.
     *
     * @Route("/detail/{id}/5986", name="vidange_show")
     *
     */
    public function showAction(Request $request, Vidange $vidange)
    {
        $em = $this->getDoctrine()->getManager();

        $listePieces = $em->getRepository('GroupeBundle:ListePiece')->findBy(
            array(),
            array('nom' => 'asc')
        );

        return $this->render('@Groupe/vidange/show.html.twig',array(
            'vidange' => $vidange,
            'listePieces' => $listePieces,

        ));



    }

    /**
     * Lists all site entities.
     *
     * @Route("/modifer/500/{id}", name="vidange_edit")
     *
     */
    public function editAction(Request $request, Vidange $vidange)
    {

        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $vidange->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateVidange']));
            $vidange->setType($_POST['typeVidange']);
            $vidange->setHeureMarche($_POST['heureMarche']);

            if (isset($_POST['descriptionVidange']))
                $vidange->setDescription($_POST['descriptionVidange'])
            ;

            $historiqueGroupe = $em->getRepository('GroupeBundle:HistoriqueGroupe')->findOneBy(array(
                'vidange' => $vidange
            ));

            $historiqueGroupe->setVidange($vidange);
            $historiqueGroupe->setDate($vidange->getDate());

            $em->persist($vidange);
            $em->persist($historiqueGroupe);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle('Information du vidange: '. $vidange->getType().'modifié');
            $historiqueGlobal->setLien($this->generateUrl('vidange_show',array('id'=>$vidange->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('vidange_show', array('id' => $vidange->getId()));
        }

        throw new Exception('Erreur! 404 NOT-FOUND');

    }

    /**
     * Lists all site entities.
     *
     * @Route("/ajouter/200/piece/500/{id}", name="vidange_ajouterSuiviPiece")
     *
     */
    public function ajouterSuiviPieceAction(Request $request, Vidange $vidange)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $groupe = $vidange->getGroupe();

            $suivi = new SuiviPiece();
            $suivi->setLibelle($_POST['libelleSuivi']);
            $suivi->setGroupe($groupe);
            $suivi->setDate($vidange->getDate());

            //---------SET VIDANGE---------

            $suivi->setVidange($vidange);

            $typePiece = $em->getRepository('GroupeBundle:ListePiece')->findOneBy(
                array('id' => $_POST['typePiece'])
            );

            $suivi->setTypePiece($typePiece);

            if (isset($_POST['descriptionSuivi']))
                $suivi->setDescription($_POST['descriptionSuivi']);

            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setDate($suivi->getDate());
            $historiqueGroupe->setSuiviPiece($suivi);
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($suivi);
            $em->persist($historiqueGroupe);

            $em->flush();

            return $this->redirectToRoute('vidange_show', array('id' => $vidange->getId()));
        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }
}
