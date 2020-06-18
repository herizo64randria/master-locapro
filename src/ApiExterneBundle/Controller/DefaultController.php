<?php

namespace ApiExterneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/test")
     */
    public function indexAction()
    {

        $response = new Response();
        $array = array('test' => 200);
        $response->setContent(json_encode($array));

        return $response;
    }
}
