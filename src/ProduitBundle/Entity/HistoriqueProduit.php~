<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueProduit
 *
 * @ORM\Table(name="historique_produit")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\HistoriqueProduitRepository")
 */
class HistoriqueProduit
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="quantite", type="float")
     */
    private $quantite;

//------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit", inversedBy="historiqueProduits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Entre")
     * @ORM\JoinColumn(nullable=true)
     */
    private $entre;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Sortie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sortie;
    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Deplacement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $deplacement;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Depot")
     * @ORM\JoinColumn(nullable=false)
     */
    private $depot;



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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return HistoriqueProduit
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return HistoriqueProduit
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     *
     * @return HistoriqueProduit
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
     * @return HistoriqueProduit
     */
    public function setEntre(\GestionBundle\Entity\Entre $entre = null)
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
     * Set depot
     *
     * @param \ProduitBundle\Entity\Depot $depot
     *
     * @return HistoriqueProduit
     */
    public function setDepot(\ProduitBundle\Entity\Depot $depot)
    {
        $this->depot = $depot;

        return $this;
    }

    /**
     * Get depot
     *
     * @return \ProduitBundle\Entity\Depot
     */
    public function getDepot()
    {
        return $this->depot;
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     *
     * @return HistoriqueProduit
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
     * Set sortie
     *
     * @param \GestionBundle\Entity\Sortie $sortie
     *
     * @return HistoriqueProduit
     */
    public function setSortie(\GestionBundle\Entity\Sortie $sortie = null)
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
     * Set deplacement
     *
     * @param \GestionBundle\Entity\Deplacement $deplacement
     *
     * @return HistoriqueProduit
     */
    public function setDeplacement(\GestionBundle\Entity\Deplacement $deplacement = null)
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
}
