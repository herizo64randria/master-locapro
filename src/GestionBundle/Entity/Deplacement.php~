<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deplacement
 *
 * @ORM\Table(name="deplacement")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\DeplacementRepository")
 */
class Deplacement
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateOperation", type="datetime")
     */
    private $dateOperation;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255 , nullable=true)
     */
    private $etat;

    /**
     * @var bool
     *
     * @ORM\Column(name="modifiable", type="boolean")
     */
    private $modifiable;

    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="string", length=255, nullable=true)
     */
    private $motif;
    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", nullable=true)
     */
    private $texte;

//------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\ligneDeplacement", mappedBy="deplacement")
     */
    private $lignedeplacement; // Notez le « s », un stocks est liée à plusieurs ligne

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCreer;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Depot", inversedBy="sourcedeplacements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sourcedepot;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Depot", inversedBy="destinationdeplacements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $destinationdepot;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site", inversedBy="sourcedeplacements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sourcesite;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site", inversedBy="destinationdeplacements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $destinationsite;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", cascade={"persist"})
     */
    private $userConfirmes;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userRefuser;

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\PieceJointe", mappedBy="deplacement")
     */
    private $pjDeplacements; // Notez le « s »,
//------------------------------------------////////////////////

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignedeplacement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etat = 'En cour de création';
        $this->modifiable = true;
        $this->dateOperation = new \DateTime();
    }

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
     * @return Deplacement
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
     * Set numero
     *
     * @param string $numero
     *
     * @return Deplacement
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Deplacement
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set modifiable
     *
     * @param boolean $modifiable
     *
     * @return Deplacement
     */
    public function setModifiable($modifiable)
    {
        $this->modifiable = $modifiable;

        return $this;
    }

    /**
     * Get modifiable
     *
     * @return bool
     */
    public function getModifiable()
    {
        return $this->modifiable;
    }

    /**
     * Set motif
     *
     * @param string $motif
     *
     * @return Deplacement
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif
     *
     * @return string
     */
    public function getMotif()
    {
        return $this->motif;
    }


    /**
     * Add lignedeplacement
     *
     * @param \GestionBundle\Entity\ligneDeplacement $lignedeplacement
     *
     * @return Deplacement
     */
    public function addLignedeplacement(\GestionBundle\Entity\ligneDeplacement $lignedeplacement)
    {
        $this->lignedeplacement[] = $lignedeplacement;

        return $this;
    }

    /**
     * Remove lignedeplacement
     *
     * @param \GestionBundle\Entity\ligneDeplacement $lignedeplacement
     */
    public function removeLignedeplacement(\GestionBundle\Entity\ligneDeplacement $lignedeplacement)
    {
        $this->lignedeplacement->removeElement($lignedeplacement);
    }

    /**
     * Get lignedeplacement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignedeplacement()
    {
        return $this->lignedeplacement;
    }

    /**
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return Deplacement
     */
    public function setUserCreer(\UserBundle\Entity\User $userCreer)
    {
        $this->userCreer = $userCreer;

        return $this;
    }

    /**
     * Get userCreer
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserCreer()
    {
        return $this->userCreer;
    }


    /**
     * Set dateOperation
     *
     * @param \DateTime $dateOperation
     *
     * @return Deplacement
     */
    public function setDateOperation($dateOperation)
    {
        $this->dateOperation = $dateOperation;

        return $this;
    }

    /**
     * Get dateOperation
     *
     * @return \DateTime
     */
    public function getDateOperation()
    {
        return $this->dateOperation;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Deplacement
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set sourcedepot
     *
     * @param \ProduitBundle\Entity\Depot $sourcedepot
     *
     * @return Deplacement
     */
    public function setSourcedepot(\ProduitBundle\Entity\Depot $sourcedepot = null)
    {
        $this->sourcedepot = $sourcedepot;

        return $this;
    }

    /**
     * Get sourcedepot
     *
     * @return \ProduitBundle\Entity\Depot
     */
    public function getSourcedepot()
    {
        return $this->sourcedepot;
    }

    /**
     * Set destinationdepot
     *
     * @param \ProduitBundle\Entity\Depot $destinationdepot
     *
     * @return Deplacement
     */
    public function setDestinationdepot(\ProduitBundle\Entity\Depot $destinationdepot = null)
    {
        $this->destinationdepot = $destinationdepot;

        return $this;
    }

    /**
     * Get destinationdepot
     *
     * @return \ProduitBundle\Entity\Depot
     */
    public function getDestinationdepot()
    {
        return $this->destinationdepot;
    }

    /**
     * Set sourcesite
     *
     * @param \GroupeBundle\Entity\Site $sourcesite
     *
     * @return Deplacement
     */
    public function setSourcesite(\GroupeBundle\Entity\Site $sourcesite = null)
    {
        $this->sourcesite = $sourcesite;

        return $this;
    }

    /**
     * Get sourcesite
     *
     * @return \GroupeBundle\Entity\Site
     */
    public function getSourcesite()
    {
        return $this->sourcesite;
    }

    /**
     * Set destinationsite
     *
     * @param \GroupeBundle\Entity\Site $destinationsite
     *
     * @return Deplacement
     */
    public function setDestinationsite(\GroupeBundle\Entity\Site $destinationsite = null)
    {
        $this->destinationsite = $destinationsite;

        return $this;
    }

    /**
     * Get destinationsite
     *
     * @return \GroupeBundle\Entity\Site
     */
    public function getDestinationsite()
    {
        return $this->destinationsite;
    }

    /**
     * Add userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return Deplacement
     */
    public function addUserConfirme(\UserBundle\Entity\User $userConfirme)
    {
        $this->userConfirmes[] = $userConfirme;

        return $this;
    }

    /**
     * Remove userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     */
    public function removeUserConfirme(\UserBundle\Entity\User $userConfirme)
    {
        $this->userConfirmes->removeElement($userConfirme);
    }

    /**
     * Get userConfirmes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserConfirmes()
    {
        return $this->userConfirmes;
    }

    /**
     * Set userRefuser
     *
     * @param \UserBundle\Entity\User $userRefuser
     *
     * @return Deplacement
     */
    public function setUserRefuser(\UserBundle\Entity\User $userRefuser = null)
    {
        $this->userRefuser = $userRefuser;

        return $this;
    }

    /**
     * Get userRefuser
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserRefuser()
    {
        return $this->userRefuser;
    }

    /**
     * Add pjDeplacement
     *
     * @param \GestionBundle\Entity\PieceJointe $pjDeplacement
     *
     * @return Deplacement
     */
    public function addPjDeplacement(\GestionBundle\Entity\PieceJointe $pjDeplacement)
    {
        $this->pjDeplacements[] = $pjDeplacement;

        return $this;
    }

    /**
     * Remove pjDeplacement
     *
     * @param \GestionBundle\Entity\PieceJointe $pjDeplacement
     */
    public function removePjDeplacement(\GestionBundle\Entity\PieceJointe $pjDeplacement)
    {
        $this->pjDeplacements->removeElement($pjDeplacement);
    }

    /**
     * Get pjDeplacements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPjDeplacements()
    {
        return $this->pjDeplacements;
    }
}
