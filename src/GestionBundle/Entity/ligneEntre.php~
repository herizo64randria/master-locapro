<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ligneEntre
 *
 * @ORM\Table(name="ligne_entre")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\ligneEntreRepository")
 */
class ligneEntre
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
     * @var float
     *
     * @ORM\Column(name="prixAchat", type="float", nullable=true)
     */
    private $prixAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="utilite", type="string", length=255, nullable=true)
     */
    private $utilite;

//------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Entre", inversedBy="ligneEntres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entre;

//------------\\\\\\\////////////-----------


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
     * Set quantite
     *
     * @param float $quantite
     *
     * @return ligneEntre
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
     * @return ligneEntre
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
     * Set prixAchat
     *
     * @param float $prixAchat
     *
     * @return ligneEntre
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return float
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     *
     * @return ligneEntre
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
     * Set entre
     *
     * @param \GestionBundle\Entity\Entre $entre
     *
     * @return ligneEntre
     */
    public function setEntre(\GestionBundle\Entity\Entre $entre)
    {
        $this->entre = $entre;

        return $this;
    }

    /**
     * Get entre
     *
     * @return \GestionBundle\Entity\Entre
     */
    public function getEntre()
    {
        return $this->entre;
    }

    /**
     * Set utilite
     *
     * @param string $utilite
     *
     * @return ligneEntre
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
}
