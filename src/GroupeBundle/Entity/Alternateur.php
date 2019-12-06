<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alternateur
 *
 * @ORM\Table(name="alternateur")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\AlternateurRepository")
 */
class Alternateur
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
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255)
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroSerie", type="string", length=255)
     */
    private $numeroSerie;

    /**
     * @var float
     *
     * @ORM\Column(name="annee", type="float")
     */
    private $annee;

    /**
     * @var float
     *
     * @ORM\Column(name="puissance", type="float")
     */
    private $puissance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebutService", type="datetime", nullable=true)
     */
    private $dateDebutService;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Alternateur
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Alternateur
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set numeroSerie
     *
     * @param string $numeroSerie
     *
     * @return Alternateur
     */
    public function setNumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    /**
     * Get numeroSerie
     *
     * @return string
     */
    public function getNumeroSerie()
    {
        return $this->numeroSerie;
    }

    /**
     * Set annee
     *
     * @param float $annee
     *
     * @return Alternateur
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return float
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set puissance
     *
     * @param float $puissance
     *
     * @return Alternateur
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
     * Set dateDebutService
     *
     * @param \DateTime $dateDebutService
     *
     * @return Alternateur
     */
    public function setDateDebutService($dateDebutService)
    {
        $this->dateDebutService = $dateDebutService;

        return $this;
    }

    /**
     * Get dateDebutService
     *
     * @return \DateTime
     */
    public function getDateDebutService()
    {
        return $this->dateDebutService;
    }
}
