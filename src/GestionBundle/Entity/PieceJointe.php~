<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PieceJointe
 *
 * @ORM\Table(name="piece_jointe")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\PieceJointeRepository")
 */
class PieceJointe
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    //---------------------------  RELATIONS  -------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Sortie", inversedBy="pjSorties")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sortie;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Entre", inversedBy="pjEntres")
     * @ORM\JoinColumn(nullable=true)
     */
    private $entre;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Commande", inversedBy="pjCommandes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\Deplacement", inversedBy="pjDeplacements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $deplacement;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\BonExpedition", inversedBy="pjBonExpeditions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $bonExpedition;

    /**
     * @ORM\ManyToOne(targetEntity="GestionBundle\Entity\BonLivraison", inversedBy="pjBonLivraisons")
     * @ORM\JoinColumn(nullable=true)
     */
    private $bonLivraison;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCreer;

    //-----------------------------/// RELATIONS ///-----------------------------


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
     * @return PieceJointe
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
     * Set url
     *
     * @param string $url
     *
     * @return PieceJointe
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set sortie
     *
     * @param \GestionBundle\Entity\Sortie $sortie
     *
     * @return PieceJointe
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
     * Set entre
     *
     * @param \GestionBundle\Entity\Entre $entre
     *
     * @return PieceJointe
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
     * Set commande
     *
     * @param \GestionBundle\Entity\Commande $commande
     *
     * @return PieceJointe
     */
    public function setCommande(\GestionBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \GestionBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set deplacement
     *
     * @param \GestionBundle\Entity\Deplacement $deplacement
     *
     * @return PieceJointe
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

    /**
     * Set bonExpedition
     *
     * @param \GestionBundle\Entity\BonExpedition $bonExpedition
     *
     * @return PieceJointe
     */
    public function setBonExpedition(\GestionBundle\Entity\BonExpedition $bonExpedition = null)
    {
        $this->bonExpedition = $bonExpedition;

        return $this;
    }

    /**
     * Get bonExpedition
     *
     * @return \GestionBundle\Entity\BonExpedition
     */
    public function getBonExpedition()
    {
        return $this->bonExpedition;
    }

    /**
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return PieceJointe
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
     * Set bonLivraison
     *
     * @param \GestionBundle\Entity\BonLivraison $bonLivraison
     *
     * @return PieceJointe
     */
    public function setBonLivraison(\GestionBundle\Entity\BonLivraison $bonLivraison = null)
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
