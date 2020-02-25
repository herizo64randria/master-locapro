<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ligneDeplacement
 *
 * @ORM\Table(name="ligne_deplacement")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\ligneDeplacementRepository")
 */
class ligneDeplacement
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
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255, nullable=true)
     */
    private $designation;

//------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Huile")
     * @ORM\JoinColumn(nullable=true)
     */
    private $huile;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Deplacement", inversedBy="lignedeplacement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deplacement;

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
     * @param integer $quantite
     *
     * @return ligneDeplacement
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
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
     * @return ligneDeplacement
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
     * @return ligneDeplacement
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
     * Set deplacement
     *
     * @param \GestionBundle\Entity\Deplacement $deplacement
     *
     * @return ligneDeplacement
     */
    public function setDeplacement(\GestionBundle\Entity\Deplacement $deplacement)
    {
        $this->deplacement = $deplacement;

        return $this;
    }

    /**
     * Get deplacement
     *
     * @return \GestionBundle\Entity\Deplacement
     */
    public function getDeplacement()
    {
        return $this->deplacement;
    }

    /**
     * Set huile
     *
     * @param \ProduitBundle\Entity\Huile $huile
     *
     * @return ligneDeplacement
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
