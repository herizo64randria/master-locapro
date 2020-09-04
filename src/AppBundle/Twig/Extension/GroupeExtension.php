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
            new \Twig_SimpleFilter('origineNum', array($this, 'getOrigineNum')),
            new \Twig_SimpleFilter('affichageHm', array($this, 'affichageHeureMinute')),
            new \Twig_SimpleFilter('hmDate', array($this, 'heureMarcheParDate')),
            new \Twig_SimpleFilter('vidangeParDate', array($this, 'vidangeParDate')),
            new \Twig_SimpleFilter('appointParDate', array($this, 'appointParDate')),
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

    public function getEtatAppointByDate(\DateTime $dateTime, Groupe $groupe){
        $respositoryAppoint = $this->em->getRepository('GroupeBundle:Appoint');

        $appoints = $respositoryAppoint->findBy(array(
            'groupe' => $groupe
        ));

        if (count($appoints) < 0)
            return false;

        $testDate = $dateTime->format('dmY');
        foreach ($appoints as $appoint){
            if ($appoint->getDate()->format('dmY') == $testDate)
                return $appoint;
        }

        return false;
    }

    public function getEtatVidangeByDate(\DateTime $dateTime, Groupe $groupe){
        $respositoryVidange = $this->em->getRepository('GroupeBundle:Vidange');

        $vidanges = $respositoryVidange->findBy(array(
            'groupe' => $groupe
        ));

        if (count($vidanges) < 0)
            return false;

        $testDate = $dateTime->format('dmY');
        foreach ($vidanges as $vidange){
            if ($vidange->getDate()->format('dmY') == $testDate)
                return $vidange;
        }

        return false;
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

     public function getOrigineNum($numero){
        $num = "$numero[10]$numero[11]$numero[4]$numero[5]$numero[6]";
        return $num;
    }

    public function affichageHeureMinute($heure_, $minute){

        $h = $heure_;
        $m = $minute;

        if($h <= 0 and $m <= 0)
            return '-';

        if (is_float($heure_) or is_float($minute)){
            $hTotal = $heure_;
            $hMarche = (int)$hTotal;
            $restehTotal = $hTotal-$hMarche;

            $mTotal = (int)$minute;
            $mTotal = $mTotal + ($hMarche * 60) + ($restehTotal * 60);

            $h = (int)($mTotal / 60);
            $m = (int)fmod($mTotal, 60);

        }

        if($h < 10)
            $h = "0".$h;

        if ($m < 10)
            $m = "0".$m;

        if($h == 0 or $h == null)
            $h = "00";

        if ($m == 0 or $m == null)
            $m = "00";

        return $h."h".$m."m";
    }

    public function heureMarcheParDate(Groupe $groupe, $dateString)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $dateString);
        $dateDebut = $date->format('Y-m-d 00:00:00');
        $dateFin = $date->format('Y-m-d 23:59:59');

        $heureMarches = $this->em->getRepository('GroupeBundle:HeureMarche')
            ->findByDateAndGroupe($groupe, $dateDebut, $dateFin);

        if(! $heureMarches)
            return null;

        $heure = null;
        foreach ($heureMarches as $heureMarche){
            $heure = $heureMarche;
        }

        return $heure;

    }

    public function vidangeParDate(Groupe $groupe, $dateString)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $dateString);
        $dateDebut = $date->format('Y-m-d 00:00:00');
        $dateFin = $date->format('Y-m-d 23:59:59');

        $vidanges = $this->em->getRepository('GroupeBundle:Vidange')
            ->findByDateAndGroupe($groupe, $dateDebut, $dateFin);

        if(! $vidanges)
            return null;

        $returnVidange = null;
        foreach ($vidanges as $vidange){
            $returnVidange = $vidange;
        }

        return $returnVidange;

    }

    public function appointParDate(Groupe $groupe, $dateString)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $dateString);
        $dateDebut = $date->format('Y-m-d 00:00:00');
        $dateFin = $date->format('Y-m-d 23:59:59');

        $appoints = $this->em->getRepository('GroupeBundle:Appoint')
            ->findByDateAndGroupe($groupe, $dateDebut, $dateFin);

        if(! $appoints)
            return null;

        $returnAppoint = null;
        foreach ($appoints as $appoint){
            $returnAppoint = $appoint;
        }

        return $returnAppoint;

    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'groupe';
    }
}
