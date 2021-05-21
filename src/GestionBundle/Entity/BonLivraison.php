<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonLivraison
 *
 * @ORM\Table(name="bon_livraison")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\BonLivraisonRepository")
 */
class BonLivraison
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
     * @ORM\Column(name="numero", type="string", length=50, unique=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50)
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
     * @ORM\Column(name="motif", type="text", nullable=true)
     */
    private $motif;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", nullable=true)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrivee", type="datetime", nullable=true)
     */
    private $dateArrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=50, nullable=true)
     */
    private $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="agent", type="string", length=50, nullable=true)
     */
    private $agent;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_agent", type="string", length=50, nullable=true)
     */
    private $contactAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="poste_agent", type="string", length=50, nullable=true)
     */
    private $posteAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="agent2", type="string", length=50, nullable=true)
     */
    private $agent2;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_agent2", type="string", length=50, nullable=true)
     */
    private $contactAgent2;

    /**
     * @var string
     *
     * @ORM\Column(name="poste_agent2", type="string", length=50, nullable=true)
     */
    private $posteAgent2;


//-------------------------------------------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\ligneBonLivraison", mappedBy="bonLivraison")
     */
    private $ligneBonLivraisons; // Notez le « s », un stocks est liée à plusieurs ligne

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCreer;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Depot", inversedBy="bonLivraisons")
     * @ORM\JoinColumn(nullable=true)
     */
    private $depot;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site", inversedBy="bonLivraisons")
     * @ORM\JoinColumn(nullable=true)
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site")
     * @ORM\JoinColumn(nullable=true)
     */
    private $siteDestination;

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
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=true)
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\PieceJointe", mappedBy="bonLivraison")
     */
    private $pjBonLivraisons; // Notez le « s »,

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\ligneCommentaireLivraison", mappedBy="bonLivraison")
     */
    private $ligneCommantaireLivraisons; // Notez le « s », un stocks est liée à plusieurs ligne

//-------------------------//////////---------------------------//////////---------------------------


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
     * Constructor
     */
    public function __construct()
    {
        $this->ligneBonLivraisons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userConfirmes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pjBonLivraisons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etat = 'En cour de création';
        $this->modifiable = true;
        $this->dateOperation = new \DateTime();

    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return BonLivraison
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
     * Set dateOperation
     *
     * @param \DateTime $dateOperation
     *
     * @return BonLivraison
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
     * Set numero
     *
     * @param string $numero
     *
     * @return BonLivraison
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
     * @return BonLivraison
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
     * @return BonLivraison
     */
    public function setModifiable($modifiable)
    {
        $this->modifiable = $modifiable;

        return $this;
    }

    /**
     * Get modifiable
     *
     * @return boolean
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
     * @return BonLivraison
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
     * Set texte
     *
     * @param string $texte
     *
     * @return BonLivraison
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
     * Set dateArrivee
     *
     * @param \DateTime $dateArrivee
     *
     * @return BonLivraison
     */
    public function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    /**
     * Get dateArrivee
     *
     * @return \DateTime
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * Add ligneBonLivraison
     *
     * @param \GestionBundle\Entity\ligneBonLivraison $ligneBonLivraison
     *
     * @return BonLivraison
     */
    public function addLigneBonLivraison(\GestionBundle\Entity\ligneBonLivraison $ligneBonLivraison)
    {
        $this->ligneBonLivraisons[] = $ligneBonLivraison;

        return $this;
    }

    /**
     * Remove ligneBonLivraison
     *
     * @param \GestionBundle\Entity\ligneBonLivraison $ligneBonLivraison
     */
    public function removeLigneBonLivraison(\GestionBundle\Entity\ligneBonLivraison $ligneBonLivraison)
    {
        $this->ligneBonLivraisons->removeElement($ligneBonLivraison);
    }

    /**
     * Get ligneBonLivraisons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneBonLivraisons()
    {
        return $this->ligneBonLivraisons;
    }

    /**
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return BonLivraison
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
     * Set depot
     *
     * @param \ProduitBundle\Entity\Depot $depot
     *
     * @return BonLivraison
     */
    public function setDepot(\ProduitBundle\Entity\Depot $depot = null)
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
     * Set site
     *
     * @param \GroupeBundle\Entity\Site $site
     *
     * @return BonLivraison
     */
    public function setSite(\GroupeBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \GroupeBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set siteDestination
     *
     * @param \GroupeBundle\Entity\Site $siteDestination
     *
     * @return BonLivraison
     */
    public function setSiteDestination(\GroupeBundle\Entity\Site $siteDestination = null)
    {
        $this->siteDestination = $siteDestination;

        return $this;
    }

    /**
     * Get siteDestination
     *
     * @return \GroupeBundle\Entity\Site
     */
    public function getSiteDestination()
    {
        return $this->siteDestination;
    }

    /**
     * Add userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return BonLivraison
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
     * @return BonLivraison
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
     * Set groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return BonLivraison
     */
    public function setGroupe(\GroupeBundle\Entity\Groupe $groupe = null)
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
     * Add pjBonLivraison
     *
     * @param \GestionBundle\Entity\PieceJointe $pjBonLivraison
     *
     * @return BonLivraison
     */
    public function addPjBonLivraison(\GestionBundle\Entity\PieceJointe $pjBonLivraison)
    {
        $this->pjBonLivraisons[] = $pjBonLivraison;

        return $this;
    }

    /**
     * Remove pjBonLivraison
     *
     * @param \GestionBundle\Entity\PieceJointe $pjBonLivraison
     */
    public function removePjBonLivraison(\GestionBundle\Entity\PieceJointe $pjBonLivraison)
    {
        $this->pjBonLivraisons->removeElement($pjBonLivraison);
    }

    /**
     * Get pjBonLivraisons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPjBonLivraisons()
    {
        return $this->pjBonLivraisons;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return BonLivraison
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set agent
     *
     * @param string $agent
     *
     * @return BonLivraison
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set contactAgent
     *
     * @param string $contactAgent
     *
     * @return BonLivraison
     */
    public function setContactAgent($contactAgent)
    {
        $this->contactAgent = $contactAgent;

        return $this;
    }

    /**
     * Get contactAgent
     *
     * @return string
     */
    public function getContactAgent()
    {
        return $this->contactAgent;
    }

    /**
     * Set posteAgent
     *
     * @param string $posteAgent
     *
     * @return BonLivraison
     */
    public function setPosteAgent($posteAgent)
    {
        $this->posteAgent = $posteAgent;

        return $this;
    }

    /**
     * Get posteAgent
     *
     * @return string
     */
    public function getPosteAgent()
    {
        return $this->posteAgent;
    }

    /**
     * Set agent2
     *
     * @param string $agent2
     *
     * @return BonLivraison
     */
    public function setAgent2($agent2)
    {
        $this->agent2 = $agent2;

        return $this;
    }

    /**
     * Get agent2
     *
     * @return string
     */
    public function getAgent2()
    {
        return $this->agent2;
    }

    /**
     * Set contactAgent2
     *
     * @param string $contactAgent2
     *
     * @return BonLivraison
     */
    public function setContactAgent2($contactAgent2)
    {
        $this->contactAgent2 = $contactAgent2;

        return $this;
    }

    /**
     * Get contactAgent2
     *
     * @return string
     */
    public function getContactAgent2()
    {
        return $this->contactAgent2;
    }

    /**
     * Set posteAgent2
     *
     * @param string $posteAgent2
     *
     * @return BonLivraison
     */
    public function setPosteAgent2($posteAgent2)
    {
        $this->posteAgent2 = $posteAgent2;

        return $this;
    }

    /**
     * Get posteAgent2
     *
     * @return string
     */
    public function getPosteAgent2()
    {
        return $this->posteAgent2;
    }

    /**
     * Add ligneCommantaireLivraison
     *
     * @param \GestionBundle\Entity\ligneCommentaireLivraison $ligneCommantaireLivraison
     *
     * @return BonLivraison
     */
    public function addLigneCommantaireLivraison(\GestionBundle\Entity\ligneCommentaireLivraison $ligneCommantaireLivraison)
    {
        $this->ligneCommantaireLivraisons[] = $ligneCommantaireLivraison;

        return $this;
    }

    /**
     * Remove ligneCommantaireLivraison
     *
     * @param \GestionBundle\Entity\ligneCommentaireLivraison $ligneCommantaireLivraison
     */
    public function removeLigneCommantaireLivraison(\GestionBundle\Entity\ligneCommentaireLivraison $ligneCommantaireLivraison)
    {
        $this->ligneCommantaireLivraisons->removeElement($ligneCommantaireLivraison);
    }

    /**
     * Get ligneCommantaireLivraisons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneCommantaireLivraisons()
    {
        return $this->ligneCommantaireLivraisons;
    }
}
