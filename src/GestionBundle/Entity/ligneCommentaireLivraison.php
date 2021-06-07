<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ligneCommentaireLivraison
 *
 * @ORM\Table(name="ligne_commentaire_livraison")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\ligneCommentaireLivraisonRepository")
 */
class ligneCommentaireLivraison
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
     * @ORM\Column(name="quantite", type="float", nullable=true)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="text", nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="text", nullable=true)
     */
    private $observation;

    /**
     * @var float
     *
     * @ORM\Column(name="ligne", type="float")
     */
    private $ligne;

    // ------------------ LIAISON ------------------

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\BonLivraison", inversedBy="ligneCommantaireLivraisons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bonLivraison;

    // ------------------///// LIAISON /////------------------


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
     * @return ligneCommentaireLivraison
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
     * @return ligneCommentaireLivraison
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
     * Set observation
     *
     * @param string $observation
     *
     * @return ligneCommentaireLivraison
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
     * Set ligne
     *
     * @param float $ligne
     *
     * @return ligneCommentaireLivraison
     */
    public function setLigne($ligne)
    {
        $this->ligne = $ligne;

        return $this;
    }

    /**
     * Get ligne
     *
     * @return float
     */
    public function getLigne()
    {
        return $this->ligne;
    }

    /**
     * Set bonLivraison
     *
     * @param \GestionBundle\Entity\BonLivraison $bonLivraison
     *
     * @return ligneCommentaireLivraison
     */
    public function setBonLivraison(\GestionBundle\Entity\BonLivraison $bonLivraison)
    {
        $this->bonLivraison = $bonLivraison;

        return $this;
    }

    /**
     * Get bonLivraison
     *
     * @return \GestionBundle\Entity\BonLivraison
     */
    public function getBonLivraison()
    {
        return $this->bonLivraison;
    }
}
