<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depot
 *
 * @ORM\Table(name="depot")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\DepotRepository")
 */
class Depot
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
     * @ORM\Column(name="nom", type="string", length=100, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="abrv", type="string", length=10, unique=true)
     */
    private $abrv;

    /**
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean")
     */
    private $etat;

//------------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Entre", mappedBy="depot")
     */
    private $Entres; // Notez le « s », un stocks est liée à plusieurs entrées

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Sortie", mappedBy="depot")
     */
    private $sorties; // Notez le « s », un stocks est liée à plusieurs entrées

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Deplacement", mappedBy="sourcedepot")
     */
    private $sourcedeplacements; // Notez le « s », un stocks est liée à plusieurs entrées

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Deplacement", mappedBy="destinationdepot")
     */
    private $destinationdeplacements; // Notez le « s », un stocks est liée à plusieurs entrées


//------------------------------------------------


    public function __construct()
    {
        $this->Entres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sorties = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Depot
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
     * Set abrv
     *
     * @param string $abrv
     *
     * @return Depot
     */
    public function setAbrv($abrv)
    {
        $this->abrv = $abrv;

        return $this;
    }

    /**
     * Get abrv
     *
     * @return string
     */
    public function getAbrv()
    {
        return $this->abrv;
    }


    /**
     * Add entre
     *
     * @param \GestionBundle\Entity\Entre $entre
     *
     * @return Depot
     */
    public function addEntre(\GestionBundle\Entity\Entre $entre)
    {
        $this->Entres[] = $entre;

        return $this;
    }

    /**
     * Remove entre
     *
     * @param \GestionBundle\Entity\Entre $entre
     */
    public function removeEntre(\GestionBundle\Entity\Entre $entre)
    {
        $this->Entres->removeElement($entre);
    }

    /**
     * Get entres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntres()
    {
        return $this->Entres;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     *
     * @return Depot
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Add sorty
     *
     * @param \GestionBundle\Entity\Sortie $sorty
     *
     * @return Depot
     */
    public function addSorty(\GestionBundle\Entity\Sortie $sorty)
    {
        $this->sorties[] = $sorty;

        return $this;
    }

    /**
     * Remove sorty
     *
     * @param \GestionBundle\Entity\Sortie $sorty
     */
    public function removeSorty(\GestionBundle\Entity\Sortie $sorty)
    {
        $this->sorties->removeElement($sorty);
    }

    /**
     * Get sorties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSorties()
    {
        return $this->sorties;
    }
}
