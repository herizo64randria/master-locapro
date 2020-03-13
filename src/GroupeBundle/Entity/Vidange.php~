<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vidange
 *
 * @ORM\Table(name="vidange")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\VidangeRepository")
 */
class Vidange
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="heure_marche", type="float")
     */
    private $heureMarche;

    /**
     * @var float
     *
     * @ORM\Column(name="huile_utilise", type="float", nullable=true)
     */
    private $huileUtilise;


//------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupe;


    /**
     * @ORM\OneToMany(targetEntity="GroupeBundle\Entity\SuiviPiece", mappedBy="vidange")
     */
    private $suiviPieces; // Notez le « s », un stocks est liée à plusieurs ligne


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Vidange
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
     * Set description
     *
     * @param string $description
     *
     * @return Vidange
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
     * @return Vidange
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
     * Constructor
     */
    public function __construct()
    {
        $this->suiviPieces = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add suiviPiece
     *
     * @param \GroupeBundle\Entity\SuiviPiece $suiviPiece
     *
     * @return Vidange
     */
    public function addSuiviPiece(\GroupeBundle\Entity\SuiviPiece $suiviPiece)
    {
        $this->suiviPieces[] = $suiviPiece;

        return $this;
    }

    /**
     * Remove suiviPiece
     *
     * @param \GroupeBundle\Entity\SuiviPiece $suiviPiece
     */
    public function removeSuiviPiece(\GroupeBundle\Entity\SuiviPiece $suiviPiece)
    {
        $this->suiviPieces->removeElement($suiviPiece);
    }

    /**
     * Get suiviPieces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuiviPieces()
    {
        return $this->suiviPieces;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Vidange
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
     * Set heureMarche
     *
     * @param float $heureMarche
     *
     * @return Vidange
     */
    public function setHeureMarche($heureMarche)
    {
        $this->heureMarche = $heureMarche;

        return $this;
    }

    /**
     * Get heureMarche
     *
     * @return float
     */
    public function getHeureMarche()
    {
        return $this->heureMarche;
    }

    /**
     * Set huileUtilise
     *
     * @param float $huileUtilise
     *
     * @return Vidange
     */
    public function setHuileUtilise($huileUtilise)
    {
        $this->huileUtilise = $huileUtilise;

        return $this;
    }

    /**
     * Get huileUtilise
     *
     * @return float
     */
    public function getHuileUtilise()
    {
        return $this->huileUtilise;
    }
}
