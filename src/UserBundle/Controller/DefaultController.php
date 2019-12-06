<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->redirectToRoute('user_homepage', array(
            'nom' => 'allin13ramanampisoa'
        ));


    }

    public function pageTestAction($nom)
    {
        return $this->render('@User/Default/index.html.twig', array(
                'nom' => $nom
            )
        );
    }


}
