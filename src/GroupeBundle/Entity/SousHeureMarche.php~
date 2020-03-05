<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousHeureMarche
 *
 * @ORM\Table(name="sous_heure_marche")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\SousHeureMarcheRepository")
 */
class SousHeureMarche
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
     * @ORM\Column(name="heureDemarrage", type="datetime")
     */
    private $heureDemarrage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureArret", type="datetime")
     */
    private $heureArret;

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
     * @var string
     *
     * @ORM\Column(name="observation", type="text", nullable=true)
     */
    private $observation;

    // ------------------- RELATION ---------------------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\HeureMarche", inversedBy="sousHeures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $heureMarche;

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
     * Set heureDemarrage
     *
     * @param \DateTime $heureDemarrage
     *
     * @return SousHeureMarche
     */
    public function setHeureDemarrage($heureDemarrage)
    {
        $this->heureDemarrage = $heureDemarrage;

        return $this;
    }

    /**
     * Get heureDemarrage
     *
     * @return \DateTime
     */
    public function getHeureDemarrage()
    {
        return $this->heureDemarrage;
    }

    /**
     * Set heureArret
     *
     * @param \DateTime $heureArret
     *
     * @return SousHeureMarche
     */
    public function setHeureArret($heureArret)
    {
        $this->heureArret = $heureArret;

        return $this;
    }

    /**
     * Get heureArret
     *
     * @return \DateTime
     */
    public function getHeureArret()
    {
        return $this->heureArret;
    }

    /**
     * Set puissance
     *
     * @param float $puissance
     *
     * @return SousHeureMarche
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
     * Set observation
     *
     * @param string $observation
     *
     * @return SousHeureMarche
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set heureMarche
     *
     * @param \GroupeBundle\Entity\HeureMarche $heureMarche
     *
     * @return SousHeureMarche
     */
    public function setHeureMarche(\GroupeBundle\Entity\HeureMarche $heureMarche)
    {
        $this->heureMarche = $heureMarche;

        return $this;
    }

    /**
     * Get heureMarche
     *
     * @return \GroupeBundle\Entity\HeureMarche
     */
    public function getHeureMarche()
    {
        return $this->heureMarche;
    }

    /**
     * Set heure
     *
     * @param float $heure
     *
     * @return SousHeureMarche
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
}
