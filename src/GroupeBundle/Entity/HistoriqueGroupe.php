<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueGroupe
 *
 * @ORM\Table(name="historique_groupe")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\HistoriqueGroupeRepository")
 */
class HistoriqueGroupe
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

    //------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupe;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\HistoriqueEtat",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $historiqueEtat;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\SuiviPiece",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $suiviPiece;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\DeplacementGroupe",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $deplacement;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\Vidange",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $vidange;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\Probleme",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $problemeSignale;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\Probleme",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $problemeResolu;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\HeureMarche",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $heureMarche;



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
     * @return HistoriqueGroupe
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
     * Set groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return HistoriqueGroupe
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
     * Set deplacement
     *
     * @param \GroupeBundle\Entity\DeplacementGroupe $deplacement
     *
     * @return HistoriqueGroupe
     */
    public function setDeplacement(\GroupeBundle\Entity\DeplacementGroupe $deplacement = null)
    {
        $this->deplacement = $deplacement;

        return $this;
    }

    /**
     * Get deplacement
     *
     * @return \GroupeBundle\Entity\DeplacementGroupe
     */
    public function getDeplacement()
    {
        return $this->deplacement;
    }

    /**
     * Set suiviPiece
     *
     * @param \GroupeBundle\Entity\SuiviPiece $suiviPiece
     *
     * @return HistoriqueGroupe
     */
    public function setSuiviPiece(\GroupeBundle\Entity\SuiviPiece $suiviPiece = null)
    {
        $this->suiviPiece = $suiviPiece;

        return $this;
    }

    /**
     * Get suiviPiece
     *
     * @return \GroupeBundle\Entity\SuiviPiece
     */
    public function getSuiviPiece()
    {
        return $this->suiviPiece;
    }

    /**
     * Set vidange
     *
     * @param \GroupeBundle\Entity\Vidange $vidange
     *
     * @return HistoriqueGroupe
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
     * Set historiqueEtat
     *
     * @param \GroupeBundle\Entity\HistoriqueEtat $historiqueEtat
     *
     * @return HistoriqueGroupe
     */
    public function setHistoriqueEtat(\GroupeBundle\Entity\HistoriqueEtat $historiqueEtat = null)
    {
        $this->historiqueEtat = $historiqueEtat;

        return $this;
    }

    /**
     * Get historiqueEtat
     *
     * @return \GroupeBundle\Entity\HistoriqueEtat
     */
    public function getHistoriqueEtat()
    {
        return $this->historiqueEtat;
    }

    /**
     * Set problemeSignale
     *
     * @param \GroupeBundle\Entity\Probleme $problemeSignale
     *
     * @return HistoriqueGroupe
     */
    public function setProblemeSignale(\GroupeBundle\Entity\Probleme $problemeSignale = null)
    {
        $this->problemeSignale = $problemeSignale;

        return $this;
    }

    /**
     * Get problemeSignale
     *
     * @return \GroupeBundle\Entity\Probleme
     */
    public function getProblemeSignale()
    {
        return $this->problemeSignale;
    }

    /**
     * Set problemeResolu
     *
     * @param \GroupeBundle\Entity\Probleme $problemeResolu
     *
     * @return HistoriqueGroupe
     */
    public function setProblemeResolu(\GroupeBundle\Entity\Probleme $problemeResolu = null)
    {
        $this->problemeResolu = $problemeResolu;

        return $this;
    }

    /**
     * Get problemeResolu
     *
     * @return \GroupeBundle\Entity\Probleme
     */
    public function getProblemeResolu()
    {
        return $this->problemeResolu;
    }

    /**
     * Set heureMarche
     *
     * @param \GroupeBundle\Entity\HeureMarche $heureMarche
     *
     * @return HistoriqueGroupe
     */
    public function setHeureMarche(\GroupeBundle\Entity\HeureMarche $heureMarche = null)
    {
        $this->heureMarche = $heureMarche;

        return $this;
    }

    /**
     * Get heureMarche
     *
     * @return \GroupeBundle\Entity\HeureMarche
     */
    public function getHeureMarche()
    {
        return $this->heureMarche;
    }
}
