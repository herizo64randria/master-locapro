<?php

namespace AppBundle\Services;


use Doctrine\Common\Persistence\ObjectManager;
use GroupeBundle\Entity\Catalogue;
use GroupeBundle\Entity\PjCatalogue;

class UploadService
{
    public function randomLettre($len) {
        $chars = 'ABCDEFGHIJK123456789';
        $randnb = '';
        for ($i = 0; $i < $len; ++$i)
            $randnb .= substr($chars, (mt_rand() % strlen($chars)), 1);
        return $randnb;
    }

    public function uploadFichier($dossier,$type,$nom,ObjectManager $em,Catalogue $catalogue) {
             $rand = $this->randomLettre(7);
            $nom_bd=array();
            $filename=array();
            $nbr= count($_FILES[$nom]);
            for($i=0;$i<$nbr;$i++)
            {
                $filename = $_FILES[$nom]['name'][$i];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $nom_bd[$i] = $dossier.'\\'.$rand.'-'.$type.'.'.$ext;

                $resultat = move_uploaded_file($_FILES[$nom]['tmp_name'][$i],'document/'.$nom_bd[$i]);

                $pjcatalogue = new PjCatalogue();
                //return new Response($_FILES['file']['type'][$i]);

                    $pjcatalogue->setLien($nom_bd[$i]);
                    $pjcatalogue->setNom($_FILES['file']['name'][$i]);
                    $pjcatalogue->setCatalogue($catalogue);
                    $em->persist($pjcatalogue);
            }
             $em->flush();

          return $nom_bd;

    }

    public function uploadSimpleFichier($dossier,$type,$nom) {
        $rand = $this->randomLettre(7);

        $filename = $_FILES[$nom]['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $nom_bd = $dossier.'\\'.$rand.'-'.$type.'.'.$ext;

        $resultat = move_uploaded_file($_FILES[$nom]['tmp_name'],'document/'.$nom_bd);

        if ($resultat){
            return $nom_bd;
        }else{
            return false;
        }
    }

}
