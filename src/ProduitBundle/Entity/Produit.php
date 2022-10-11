<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="refEqui", type="string", length=255, nullable=true)
     */
    private $refEqui;

    /**
     * @var float
     *
     * @ORM\Column(name="prixAchat", type="float", nullable=true)
     */
    private $prixAchat;

    /**
     * @var float
     *
     * @ORM\Column(name="prixVente", type="float", nullable=true)
     */
    private $prixVente;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_total", type="integer", nullable=true)
     */
    private $stockTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="alert", type="integer", nullable=true)
     */
    private $alert;

    /**
     * @var bool
     *
     * @ORM\Column(name="si_huile", type="boolean", nullable=true)
     */
    private $siHuile;

    /**
     * @var bool
     *
     * @ORM\Column(name="huile_par_defaut", type="boolean", nullable=true)
     */
    private $huileParDefaut;

    /**
     * @var bool
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;




//------------\\\\\\\////////////-----------

    /**
     * @ORM\OneToMany(targetEntity="ProduitBundle\Entity\Stock_", mappedBy="produit")
     */
    private $stocks; // Notez le « s », un stocks est liée à plusieurs stocks

    /**
     * @ORM\OneToMany(targetEntity="ProduitBundle\Entity\HistoriqueProduit", mappedBy="produit")
     */
    private $historiqueProduits; // Notez le « s », un stocks est liée à plusieurs historiques produits
    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\ListePiece",inversedBy="produits")
     * @ORM\JoinColumn(nullable=true)
     */
    private $reflistepiece;

    /**
     * @ORM\OneToOne(targetEntity="ProduitBundle\Entity\Pvsn")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numeroSerie;


//------------\\\\\\\////////////-----------

   /**
     * Constructor
     */
    function __construct()
    {
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->historiqueProduits = new \Doctrine\Common\Collections\ArrayCollection();
    }



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
     * Set designation
     *
     * @param string $designation
     *
     * @return Produit
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
     * Set code
     *
     * @param string $code
     *
     * @return Produit
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Produit
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set refEqui
     *
     * @param string $refEqui
     *
     * @return Produit
     */
    public function setRefEqui($refEqui)
    {
        $this->refEqui = $refEqui;

        return $this;
    }

    /**
     * Get refEqui
     *
     * @return string
     */
    public function getRefEqui()
    {
        return $this->refEqui;
    }

    /**
     * Set prixAchat
     *
     * @param float $prixAchat
     *
     * @return Produit
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
     * Set prixVente
     *
     * @param float $prixVente
     *
     * @return Produit
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    /**
     * Get prixVente
     *
     * @return float
     */
    public function getPrixVente()
    {
        return $this->prixVente;
    }

    /**
     * Set stockTotal
     *
     * @param integer $stockTotal
     *
     * @return Produit
     */
    public function setStockTotal($stockTotal)
    {
        $this->stockTotal = $stockTotal;

        return $this;
    }

    /**
     * Get stockTotal
     *
     * @return integer
     */
    public function getStockTotal()
    {
        return $this->stockTotal;
    }

    /**
     * Set alert
     *
     * @param integer $alert
     *
     * @return Produit
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;

        return $this;
    }

    /**
     * Get alert
     *
     * @return integer
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * Add stock
     *
     * @param \ProduitBundle\Entity\Stock_ $stock
     *
     * @return Produit
     */
    public function addStock(\ProduitBundle\Entity\Stock_ $stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \ProduitBundle\Entity\Stock_ $stock
     */
    public function removeStock(\ProduitBundle\Entity\Stock_ $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Add historiqueProduit
     *
     * @param \ProduitBundle\Entity\HistoriqueProduit $historiqueProduit
     *
     * @return Produit
     */
    public function addHistoriqueProduit(\ProduitBundle\Entity\HistoriqueProduit $historiqueProduit)
    {
        $this->historiqueProduits[] = $historiqueProduit;

        return $this;
    }

    /**
     * Remove historiqueProduit
     *
     * @param \ProduitBundle\Entity\HistoriqueProduit $historiqueProduit
     */
    public function removeHistoriqueProduit(\ProduitBundle\Entity\HistoriqueProduit $historiqueProduit)
    {
        $this->historiqueProduits->removeElement($historiqueProduit);
    }

    /**
     * Get historiqueProduits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoriqueProduits()
    {
        return $this->historiqueProduits;
    }

    /**
     * Set siHuile
     *
     * @param boolean $siHuile
     *
     * @return Produit
     */
    public function setSiHuile($siHuile)
    {
        $this->siHuile = $siHuile;

        return $this;
    }

    /**
     * Get siHuile
     *
     * @return boolean
     */
    public function getSiHuile()
    {
        return $this->siHuile;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Produit
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
     * Set huileParDefaut
     *
     * @param boolean $huileParDefaut
     *
     * @return Produit
     */
    public function setHuileParDefaut($huileParDefaut)
    {
        $this->huileParDefaut = $huileParDefaut;

        return $this;
    }

    /**
     * Get huileParDefaut
     *
     * @return boolean
     */
    public function getHuileParDefaut()
    {
        return $this->huileParDefaut;
    }

    /**
     * Set reflistepiece
     *
     * @param \GroupeBundle\Entity\ListePiece $reflistepiece
     *
     * @return Produit
     */
    public function setReflistepiece(\GroupeBundle\Entity\ListePiece $reflistepiece = null)
    {
        $this->reflistepiece = $reflistepiece;

        return $this;
    }

    /**
     * Get reflistepiece
     *
     * @return \GroupeBundle\Entity\ListePiece
     */
    public function getReflistepiece()
    {
        return $this->reflistepiece;
    }
  /**
     * @return mixed
     */
    public function getNumeroSerie()
    {
        return $this->numeroSerie;
    }

    /**
     * @param mixed $numeroSerie
     */
    public function setNumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;
    }
    public function __toString(): string 
    {
        return $this->getNumeroSerie();
    }
}

