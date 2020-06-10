<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HeureMarche
 *
 * @ORM\Table(name="heure_marche")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\HeureMarcheRepository")
 */
class HeureMarche
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="datetime")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="datetime")
     */
    private $datefin;

    /**
     * @var float
     *
     * @ORM\Column(name="heure", type="float")
     */
    private $heure;

    /**
     * @var float
     *
     * @ORM\Column(name="puissance", type="float", nullable=true)
     */
    private $puissance;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    /**
     * @var float
     *
     * @ORM\Column(name="production", type="float", nullable=true)
     */
    private $production;

    /**
     * @var float
     *
     * @ORM\Column(name="consomation", type="float", nullable=true)
     */
    private $consomation;

    /**
     * @var float
     *
     * @ORM\Column(name="csp", type="float", nullable=true)
     */
    private $csp;


   // ------------------- RELATION ---------------------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=true)
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="GroupeBundle\Entity\SousHeureMarche", mappedBy="heureMarche")
     */
    private $sousHeures; // Notez le « s », il peu y avoir bcp

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Appoint")
     * @ORM\JoinColumn(nullable=true)
     */
    private $appoint;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Vidange")
     * @ORM\JoinColumn(nullable=true)
     */
    private $vidange;

   // ------------------- ////// RELATION ////// ---------------------


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return HeureMarche
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return HeureMarche
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set heure
     *
     * @param float $heure
     *
     * @return HeureMarche
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return float
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return HeureMarche
     */
    public function setGroupe(\GroupeBundle\Entity\Groupe $groupe = null)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \GroupeBundle\Entity\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set puissance
     *
     * @param float $puissance
     *
     * @return HeureMarche
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance
     *
     * @return float
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return HeureMarche
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sousHeures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sousHeure
     *
     * @param \GroupeBundle\Entity\SousHeureMarche $sousHeure
     *
     * @return HeureMarche
     */
    public function addSousHeure(\GroupeBundle\Entity\SousHeureMarche $sousHeure)
    {
        $this->sousHeures[] = $sousHeure;

        return $this;
    }

    /**
     * Remove sousHeure
     *
     * @param \GroupeBundle\Entity\SousHeureMarche $sousHeure
     */
    public function removeSousHeure(\GroupeBundle\Entity\SousHeureMarche $sousHeure)
    {
        $this->sousHeures->removeElement($sousHeure);
    }

    /**
     * Get sousHeures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousHeures()
    {
        return $this->sousHeures;
    }

    /**
     * Set production
     *
     * @param float $production
     *
     * @return HeureMarche
     */
    public function setProduction($production)
    {
        $this->production = $production;

        return $this;
    }

    /**
     * Get production
     *
     * @return float
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**
     * Set consomation
     *
     * @param float $consomation
     *
     * @return HeureMarche
     */
    public function setConsomation($consomation)
    {
        $this->consomation = $consomation;

        return $this;
    }

    /**
     * Get consomation
     *
     * @return float
     */
    public function getConsomation()
    {
        return $this->consomation;
    }

    /**
     * Set csp
     *
     * @param float $csp
     *
     * @return HeureMarche
     */
    public function setCsp($csp)
    {
        $this->csp = $csp;

        return $this;
    }

    /**
     * Get csp
     *
     * @return float
     */
    public function getCsp()
    {
        return $this->csp;
    }

    /**
     * Set appoint
     *
     * @param \GroupeBundle\Entity\Appoint $appoint
     *
     * @return HeureMarche
     */
    public function setAppoint(\GroupeBundle\Entity\Appoint $appoint = null)
    {
        $this->appoint = $appoint;

        return $this;
    }

    /**
     * Get appoint
     *
     * @return \GroupeBundle\Entity\Appoint
     */
    public function getAppoint()
    {
        return $this->appoint;
    }



    /**
     * Set vidange
     *
     * @param \GroupeBundle\Entity\Vidange $vidange
     *
     * @return HeureMarche
     */
    public function setVidange(\GroupeBundle\Entity\Vidange $vidange = null)
    {
        $this->vidange = $vidange;

        return $this;
    }

    /**
     * Get vidange
     *
     * @return \GroupeBundle\Entity\Vidange
     */
    public function getVidange()
    {
        return $this->vidange;
    }
}
