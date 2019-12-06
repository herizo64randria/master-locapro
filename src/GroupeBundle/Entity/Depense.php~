<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depense
 *
 * @ORM\Table(name="depense")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\DepenseRepository")
 */
class Depense
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
     * @ORM\Column(name="idDepense", type="integer")
     */
    private $idDepense;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    //-------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe", inversedBy="depenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Probleme", inversedBy="depenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $probleme;


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
     * Set idDepense
     *
     * @param integer $idDepense
     *
     * @return Depense
     */
    public function setIdDepense($idDepense)
    {
        $this->idDepense = $idDepense;

        return $this;
    }

    /**
     * Get idDepense
     *
     * @return int
     */
    public function getIdDepense()
    {
        return $this->idDepense;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Depense
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Depense
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

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Depense
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return Depense
     */
    public function setGroupe(\GroupeBundle\Entity\Groupe $groupe)
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
     * Set probleme
     *
     * @param \GroupeBundle\Entity\Probleme $probleme
     *
     * @return Depense
     */
    public function setProbleme(\GroupeBundle\Entity\Probleme $probleme)
    {
        $this->probleme = $probleme;

        return $this;
    }

    /**
     * Get probleme
     *
     * @return \GroupeBundle\Entity\Probleme
     */
    public function getProbleme()
    {
        return $this->probleme;
    }
}
