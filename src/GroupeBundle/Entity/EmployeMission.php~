<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeMission
 *
 * @ORM\Table(name="employe_mission")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\EmployeMissionRepository")
 */
class EmployeMission
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
     * @var int
     *
     * @ORM\Column(name="id_employe", type="integer")
     *
     */
    private $idEmploye;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=255)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;


    //-------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Mission", inversedBy="employeMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;


    //-------------------------------


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
     * Set nom
     *
     * @param string $nom
     *
     * @return EmployeMission
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return EmployeMission
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set idEmploye
     *
     * @param integer $idEmploye
     *
     * @return EmployeMission
     */
    public function setIdEmploye($idEmploye)
    {
        $this->idEmploye = $idEmploye;

        return $this;
    }

    /**
     * Get idEmploye
     *
     * @return integer
     */
    public function getIdEmploye()
    {
        return $this->idEmploye;
    }

    /**
     * Set mission
     *
     * @param \GroupeBundle\Entity\Mission $mission
     *
     * @return EmployeMission
     */
    public function setMission(\GroupeBundle\Entity\Mission $mission)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return \GroupeBundle\Entity\Mission
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return EmployeMission
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }
}
