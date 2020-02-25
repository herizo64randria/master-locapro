<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ligneSortie
 *
 * @ORM\Table(name="ligne_sortie")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\ligneSortieRepository")
 */
class ligneSortie
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
     * @var float
     *
     * @ORM\Column(name="quantite", type="float")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="utilite", type="string", length=255, nullable=true)
     */
    private $utilite;

    //------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=true)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Huile")
     * @ORM\JoinColumn(nullable=true)
     */
    private $huile;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Sortie", inversedBy="ligneSorties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sortie;

    //------------\\\\\\\////////////-----------

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
     * Set quantite
     *
     * @param float $quantite
     *
     * @return ligneSortie
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return float
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return ligneSortie
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     *
     * @return ligneSortie
     */
    public function setProduit(\ProduitBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \ProduitBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set sortie
     *
     * @param \GestionBundle\Entity\Sortie $sortie
     *
     * @return ligneSortie
     */
    public function setSortie(\GestionBundle\Entity\Sortie $sortie)
    {
        $this->sortie = $sortie;

        return $this;
    }

    /**
     * Get sortie
     *
     * @return \GestionBundle\Entity\Sortie
     */
    public function getSortie()
    {
        return $this->sortie;
    }

    /**
     * Set utilite
     *
     * @param string $utilite
     *
     * @return ligneSortie
     */
    public function setUtilite($utilite)
    {
        $this->utilite = $utilite;

        return $this;
    }

    /**
     * Get utilite
     *
     * @return string
     */
    public function getUtilite()
    {
        return $this->utilite;
    }

    /**
     * Set huile
     *
     * @param \ProduitBundle\Entity\Huile $huile
     *
     * @return ligneSortie
     */
    public function setHuile(\ProduitBundle\Entity\Huile $huile = null)
    {
        $this->huile = $huile;

        return $this;
    }

    /**
     * Get huile
     *
     * @return \ProduitBundle\Entity\Huile
     */
    public function getHuile()
    {
        return $this->huile;
    }
}
