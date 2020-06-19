<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonExpedition
 *
 * @ORM\Table(name="bon_expedition")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\BonExpeditionRepository")
 */
class BonExpedition
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
     * @ORM\Column(name="transporteur", type="string", length=100, nullable=true)
     */
    private $transporteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_transporteur", type="string", length=50, nullable=true)
     */
    private $contactTransporteur;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicule_transporteur", type="string", length=100, nullable=true)
     */
    private $vehiculeTransporteur;

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
     * @var float
     *
     * @ORM\Column(name="coutTransport", type="float", nullable=true)
     */
    private $coutTransport;

//---------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\ligneBonExpedition", mappedBy="bonExpedition")
     */
    private $ligneBonExpeditions; // Notez le « s », un stocks est liée à plusieurs ligne

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCreer;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Depot", inversedBy="bonExpeditions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $depot;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site", inversedBy="bonExpeditions")
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


//------------------------------------------////////////////////


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
        $this->ligneBonExpeditions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userConfirmes = new \Doctrine\Common\Collections\ArrayCollection();

        $this->etat = 'En cour de création';
        $this->modifiable = true;
        $this->dateOperation = new \DateTime();
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return BonExpedition
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
     * @return BonExpedition
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
     * @return BonExpedition
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
     * @return BonExpedition
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
     * @return BonExpedition
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
     * Set destination
     *
     * @param string $destination
     *
     * @return BonExpedition
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
     * Set motif
     *
     * @param string $motif
     *
     * @return BonExpedition
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
     * @return BonExpedition
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
     * Add ligneBonExpedition
     *
     * @param \GestionBundle\Entity\ligneBonExpedition $ligneBonExpedition
     *
     * @return BonExpedition
     */
    public function addLigneBonExpedition(\GestionBundle\Entity\ligneBonExpedition $ligneBonExpedition)
    {
        $this->ligneBonExpeditions[] = $ligneBonExpedition;

        return $this;
    }

    /**
     * Remove ligneBonExpedition
     *
     * @param \GestionBundle\Entity\ligneBonExpedition $ligneBonExpedition
     */
    public function removeLigneBonExpedition(\GestionBundle\Entity\ligneBonExpedition $ligneBonExpedition)
    {
        $this->ligneBonExpeditions->removeElement($ligneBonExpedition);
    }

    /**
     * Get ligneBonExpeditions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneBonExpeditions()
    {
        return $this->ligneBonExpeditions;
    }

    /**
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return BonExpedition
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
     * @return BonExpedition
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
     * @return BonExpedition
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
     * Add userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return BonExpedition
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
     * @return BonExpedition
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
     * @return BonExpedition
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
     * Set agent
     *
     * @param string $agent
     *
     * @return BonExpedition
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
     * @return BonExpedition
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
     * Set transporteur
     *
     * @param string $transporteur
     *
     * @return BonExpedition
     */
    public function setTransporteur($transporteur)
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    /**
     * Get transporteur
     *
     * @return string
     */
    public function getTransporteur()
    {
        return $this->transporteur;
    }

    /**
     * Set contactTransporteur
     *
     * @param string $contactTransporteur
     *
     * @return BonExpedition
     */
    public function setContactTransporteur($contactTransporteur)
    {
        $this->contactTransporteur = $contactTransporteur;

        return $this;
    }

    /**
     * Get contactTransporteur
     *
     * @return string
     */
    public function getContactTransporteur()
    {
        return $this->contactTransporteur;
    }

    /**
     * Set vehiculeTransporteur
     *
     * @param string $vehiculeTransporteur
     *
     * @return BonExpedition
     */
    public function setVehiculeTransporteur($vehiculeTransporteur)
    {
        $this->vehiculeTransporteur = $vehiculeTransporteur;

        return $this;
    }

    /**
     * Get vehiculeTransporteur
     *
     * @return string
     */
    public function getVehiculeTransporteur()
    {
        return $this->vehiculeTransporteur;
    }

    /**
     * Set coutTransport
     *
     * @param float $coutTransport
     *
     * @return BonExpedition
     */
    public function setCoutTransport($coutTransport)
    {
        $this->coutTransport = $coutTransport;

        return $this;
    }

    /**
     * Get coutTransport
     *
     * @return float
     */
    public function getCoutTransport()
    {
        return $this->coutTransport;
    }

    /**
     * Set siteDestination
     *
     * @param \GroupeBundle\Entity\Site $siteDestination
     *
     * @return BonExpedition
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
}
