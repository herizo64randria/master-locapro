<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Produit controller.
 *
 * @Route("/API/produit")
 */
class ProduitAPIController extends Controller
{
    /**
     * Lists all produit entities.
     *
     * @Route("/by/id", name="produit_api_show")
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produit = $em->getRepository('ProduitBundle:Produit')->findOneBy(array(
            'id' => $_POST['produit']
            )
        );

        $data = $this->get('jms_serializer')->serialize($produit, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Lists all produit entities.
     *
     * @Route("/by/produit/depot", name="produit_api_liste")
     */
    public function listeByDepotAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('ProduitBundle:Produit')->findAll();

        $data = $this->get('jms_serializer')->serialize($produits, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;


    }



}
