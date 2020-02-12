<?php

namespace UserBundle\Controller;

use AppBundle\Services\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Entrée controller.
 *
 * @Route("/")
 */

class GestionUserController extends Controller
{
    /**
     * INDEX
     *
     * @Route("/liste-users", name="utilisateur_index")
     */
    public function listeAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('@User/user/index.html.twig', array(
            'users' => $users,
        ));
    }
    /**
     * SHOW
     *
     * @Route("/voir-users/FCA65{id}32", name="utilisateur_show")
     */
    public function showAction(Request $request,User $user)
    {

        return $this->render('@User/user/show.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * EDIT
     *
     * @Route("/modifier-users/FCA25{id}32", name="utilisateur_edit")
     */
    public function editAction(Request $request, User $user)
    {

        if($request->getMethod()=='POST')
        {
            $userManager = $this->get('fos_user.user_manager');
            $user->setUsername($_POST['username']);
            $user->setRoles(array());
            if(isset($_POST['roles'])){
                $user->setRoles($_POST['roles']);
            }

            if($_POST['role']=='ROLE_ADMIN')
            {
                $user->setRoles(array($_POST['role']));
            }

            $user->setNom($_POST['nom']);
            if (!$_POST['passeword']=='•••••••••••••••')
                $user->setPlainPassword($_POST['passeword']);

            $user->setEmail($_POST['email']);
            $user->setEnabled(true);


            if($_FILES['image']['size'] > 0){

                $uploadService = new UploadService();

                if($image = $uploadService->uploadSimpleFichier('UserImage', 'UserImage', 'image')){
                    $user->setUrlImg($image);


                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }

            $userManager->updateUser($user);
        }
        return $this->render('@User/user/edit.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * DESACTIVER
     *
     * @Route("/desactiver-users/FCA25{id}32", name="utilisateur_des")
     */
    public function desactiverAction(Request $request,User $user)
    {
            $userManager = $this->get('fos_user.user_manager');

            $user->setEnabled(false);
            $userManager->updateUser($user);
            return $this->redirectToRoute('utilisateur_index');

    }
    /**
     * ACTIVER
     *
     * @Route("/activer-users/FCA25{id}32", name="utilisateur_act")
     */
    public function activerAction(Request $request,User $user)
    {


        $userManager = $this->get('fos_user.user_manager');

        $user->setEnabled(true);
        $userManager->updateUser($user);
        return $this->redirectToRoute('utilisateur_index');

    }
    /**
     * DELETE
     *
     * @Route("/delete-users/FCA25{id}32", name="utilisateur_delete")
     */
    public function deleteAction(Request $request,User $user)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('utilisateur_index');
    }
    /**
     * NEW
     *
     * @Route("/newusers", name="utilisateur_new")
     */
    public function newAction(Request $request)
    {
        if($request->getMethod()=='POST')
        {
            $userManager = $this->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $user->setUsername($_POST['username']);

            $user->setRoles(array($_POST['role']));
            $user->setNom($_POST['nom']);
            $user->setPlainPassword($_POST['passeword']);
            $user->setEmail($_POST['email']);
            $user->setEnabled(true);


            $userManager->updateUser($user);
            return $this->redirectToRoute('utilisateur_index');
        }



        return $this->render('@User/user/new.html.twig');
    }
}
