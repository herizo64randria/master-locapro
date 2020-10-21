<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuiviPiece
 *
 * @ORM\Table(name="suivi_piece")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\SuiviPieceRepository")
 */
class SuiviPiece
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\ListePiece")
     * @ORM\JoinColumn(nullable=true)
     */
    private $typePiece;

    /**
     * @var bool
     *
     * @ORM\Column(name="sortie_en_stock", type="boolean", nullable=true)
     */
    private $sortieEnStock;

    /**
     * @var float
     *
     * @ORM\Column(name="quantite", type="float", nullable=true)
     */
    private $quantite;


//------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Vidange", inversedBy="suiviPieces")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $vidange;

//-----------------------------------------------


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return SuiviPiece
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return SuiviPiece
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return SuiviPiece
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
     * Set typePiece
     *
     * @param \GroupeBundle\Entity\ListePiece $typePiece
     *
     * @return SuiviPiece
     */
    public function setTypePiece(\GroupeBundle\Entity\ListePiece $typePiece = null)
    {
        $this->typePiece = $typePiece;

        return $this;
    }

    /**
     * Get typePiece
     *
     * @return \GroupeBundle\Entity\ListePiece
     */
    public function getTypePiece()
    {
        return $this->typePiece;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SuiviPiece
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
     * Set vidange
     *
     * @param \GroupeBundle\Entity\Vidange $vidange
     *
     * @return SuiviPiece
     */
    public function setVidange(\GroupeBundle\Entity\Vidange $vidange = null)
    {
        $this->vidange = $vidange;

        return $this;
    }

    /**
     * Get vidange
     *
     * @return \GroupeBundle\Entity\Vidange
     */
    public function getVidange()
    {
        return $this->vidange;
    }

    /**
     * Set sortieEnStock
     *
     * @param boolean $sortieEnStock
     *
     * @return SuiviPiece
     */
    public function setSortieEnStock($sortieEnStock)
    {
        $this->sortieEnStock = $sortieEnStock;

        return $this;
    }

    /**
     * Get sortieEnStock
     *
     * @return boolean
     */
    public function getSortieEnStock()
    {
        return $this->sortieEnStock;
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     *
     * @return SuiviPiece
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
}
