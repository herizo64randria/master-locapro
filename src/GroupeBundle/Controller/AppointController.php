<?php

namespace GroupeBundle\Controller;


use AppBundle\Services\ProduitService;
use GroupeBundle\Entity\Appoint;
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
 * @Route("/appoint-hulie")
 */
class AppointController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/nouveau/500{id}", name="appoint_new")
     *
     */
    public function newAction(Request $request, Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

            $appoint = new Appoint();
            $appoint->setGroupe($groupe);
            $appoint->setDate(\DateTime::createFromFormat('d/m/Y', $_POST['dateAppoint']));

            $qttUtilise = $_POST['huileAppoint'];
            if ($qttUtilise < 0)
                throw new Exception('Erreur! Valeur de huile utilisé négatif');

            $appoint->setHuileUtilise($qttUtilise);

            if (isset($_POST['descriptionAppoint']))
                $appoint->setDescription($_POST['descriptionAppoint'])
            ;

            if (isset($_POST['chkHuileAppoint'])){
                // ------------------- HUILE UTILISE ---------------------


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
                $historiqueProduit->setAppoint($appoint);
                $historiqueProduit->setDate($appoint->getDate());
                $historiqueProduit->setQuantite($qttUtilise);
                $historiqueProduit->setSite($groupe->getSite());


                $em->persist($historiqueProduit);
            }


            // ------------------- ////// HUILE UTILISE ////// ---------------------

            $historiqueGroupe = new HistoriqueGroupe();
            $historiqueGroupe->setAppoint($appoint);
            $historiqueGroupe->setDate($appoint->getDate());
            $historiqueGroupe->setGroupe($groupe);

            $em->persist($appoint);
            $em->persist($historiqueGroupe);
            $em->flush();

            if(isset($_POST['chkHuileAppoint'])){
                // ------------------- Mis A Jour du stock d'huile ---------------------
                $serviceProduit = new ProduitService($em);
                $serviceProduit->updateStockTotal($huile);
            }

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------
            $historiqueGlobal = new HistoriqueGlobal();
            $historiqueGlobal->setUserHistorique($this->getUser());
            $historiqueGlobal->setLibelle("Appoint d\'huile du groupe: {$groupe->getNumero()}");
            $historiqueGlobal->setLien($this->generateUrl('groupe_show', array('id' => $groupe->getId())));

            $em->persist($historiqueGlobal);
            $em->flush();

            // ------------------- ////// HISTORIQUE GLOBAL ////// ---------------------

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));

        }

        throw new Exception('Erreur! 404 NOT-FOUND');
    }


}
