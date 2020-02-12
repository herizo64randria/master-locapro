<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Services\UserService;
use Doctrine\Common\Persistence\ObjectManager;
use GroupeBundle\Entity\Groupe;
use Symfony\Component\Config\Definition\Exception\Exception;
use UserBundle\Entity\User;

class GroupeExtension extends \Twig_Extension
{
    private $em;
    private $userService;

    public function __construct(ObjectManager $em, UserService $userService)
    {
        $this->em = $em;
        $this->userService = $userService;
    }



    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('listeEtatGrp', array($this, 'listeEtatFunction')),
            new \Twig_SimpleFilter('heureMarcheDate', array($this, 'heureMarcheDateFunction')),
            new \Twig_SimpleFilter('typeFile', array($this, 'getTypeFile')),
        );
    }

    public function listeEtatFunction(){

        $repositoryListeEtat = $this->em->getRepository('GroupeBundle:ListeEtatGroupe');

        $liste = $repositoryListeEtat->findAll();


        if($liste)
            return $liste;
        else
            throw new Exception('Erreur! Aucune liste d\'état groupe trouvé')
        ;
    }

    public function heureMarcheDateFunction(Groupe $groupe, \DateTime $dateDebut, \DateTime $dateFin){

        $heureMarches = $this->em->getRepository('GroupeBundle:HeureMarche')->findBy(

            array(
                'groupe' => $groupe
            ))
        ;

        $h = 0;

        foreach ($heureMarches as  $heureMarche )
        {

            if( ( $dateDebut <= $heureMarche->getDatedebut() and $heureMarche->getDatedebut() <= $dateFin) or ($dateDebut <= $heureMarche->getDatefin() and $heureMarche->getDatefin() <= $dateFin) or ($heureMarche->getDatedebut() <= $dateFin and $dateFin < $heureMarche->getDatefin()) ){

                $diffDateMarche = ($heureMarche->getDatedebut()->diff($heureMarche->getDatefin())->d) + 1;

                $hparJ = $heureMarche->getHeure() / $diffDateMarche;

                $petitDate = $dateDebut;
                $grandeDate = $dateFin;

                if($dateDebut <= $heureMarche->getDatedebut())
                    $petitDate = $heureMarche->getDatedebut();

                if ($dateFin >= $heureMarche->getDatefin())
                    $grandeDate = $heureMarche->getDatefin();

                $petitDate = \DateTime::createFromFormat('d/m/Y', $petitDate->format('d/m/Y'));
                $grandeDate = \DateTime::createFromFormat('d/m/Y', $grandeDate->format('d/m/Y'));

                $diffComprise =  $petitDate->diff($grandeDate) ;


                $dayComprise = $diffComprise->d + 1;

                $h = $h + ($hparJ * $dayComprise);
            }
        }

        if ($h <= 0)
            $h = '-'
        ;

        return $h;
    }

    function getTypeFile($nom){
        $type = 'file';

        $excel = array('xls' ,'xls','xlsx','xls','xlsm','xlt','xltx','xlt','xltm','xla','xlam');
        $audio = array('mp3', 'wma', 'ogg', 'aac');
        $video = array('avi','mp4','mov','flv','mpg');
        $image = array('tif', 'tiff', 'gif', 'jpeg', 'jpg', 'jif', 'jfif', 'jp2', 'jpx', 'j2k', 'j2c', 'fpx', 'pcd', 'png');

        $ext = substr(strrchr($nom,'.'),1);
        $ext = strtolower($ext);

        if ($ext == 'doc' or $ext == 'docx') $type = 'word';

        if(in_array($ext, $excel)) $type = 'excel';

        if ($ext == 'pdf') $type = 'pdf';

        if(in_array($ext, $audio)) $type = 'audio';

        if(in_array($ext, $video)) $type = 'video';

        if(in_array($ext, $image)) $type = 'image';

        return $type;

    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'groupe';
    }
}
