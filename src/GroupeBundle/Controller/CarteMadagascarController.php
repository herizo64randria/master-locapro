<?php

namespace GroupeBundle\Controller;

use GroupeBundle\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Site controller.
 *
 * @Route("/carte")
 */
class CarteMadagascarController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/madagascar", name="carteMadagascar_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sites = $em->getRepository('GroupeBundle:Site')->findBy(
            array(),
            array('emplacement' => 'asc'))
        ;

        return $this->render('@Groupe/carteMadagascar/index.html.twig', array(
            'sites' => $sites,
        ));
    }

    /**
     * Lists all site entities.
     *
     * @Route("/api/madagascar", name="carteMadagascar_api_infoSite")
     *
     */
    public function infoSiteAPIAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST'){
            $site = $em->getRepository('GroupeBundle:Site')->findOneBy(array(
                'id' => $_POST['idSite']
            ));

            if(count($site->getGroupes()) > 0){
                foreach ($site->getGroupes() as $groupe){
                    $groupe->setUrl($this->generateUrl('groupe_show', array('id' => $groupe->getId())));
                }
            }

            $data = $this->get('jms_serializer')->serialize($site, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

        throw new Exception('Erreur 404 NOT-FOUND');

    }


}
