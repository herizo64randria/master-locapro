<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListePiece
 *
 * @ORM\Table(name="liste_piece")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\ListePieceRepository")
 */
class ListePiece
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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;
//--------------------Relation-------------------
    /**
     * @ORM\OneToOne(targetEntity="ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;
    /**
     * @ORM\ManyToMany(targetEntity="GroupeBundle\Entity\Groupe", mappedBy="listepieces")
     */
    private $groupes;
    /**
     * @ORM\OneToMany(targetEntity="ProduitBundle\Entity\Produit",mappedBy="reflistepiece")
     * @ORM\JoinColumn(nullable=true)
     */
    private $produits;
//--------------------Fin relation---------------

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
     * @return ListePiece
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
     * Constructor
     */
    public function __construct()
    {
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     *
     * @return ListePiece
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
     * Add groupe
     *
     * @param \GroupeBundle\Entity\ListePiece $groupe
     *
     * @return ListePiece
     */
    public function addGroupe(\GroupeBundle\Entity\Groupe $groupe)
    {
        $this->groupes[] = $groupe;

        return $this;
    }

    /**
     * Remove groupe
     *
     * @param \GroupeBundle\Entity\ListePiece $groupe
     */
    public function removeGroupe(\GroupeBundle\Entity\Groupe $groupe)
    {
        $this->groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupes()
    {
        return $this->groupes;
    }

    /**
     * Add produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     *
     * @return ListePiece
     */
    public function addProduit(\ProduitBundle\Entity\Produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     */
    public function removeProduit(\ProduitBundle\Entity\Produit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }
}
