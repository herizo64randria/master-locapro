<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="string", length=255)
     */
    private $motif;
    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255,nullable=true)
     */
    private $texte;
    /**
     * @var bool
     *
     * @ORM\Column(name="modifiable", type="boolean", nullable=true)
     */
    private $modifiable;

//------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\ligneCommande", mappedBy="commande")
     */
    private $ligneCommandes;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCreer;
    
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
     * @ORM\ManyToOne(targetEntity="FournisseurBundle\Entity\Fournisseur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $fournisseur;
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commande
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
     * @param integer $numero
     *
     * @return Commande
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
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
     * @return Commande
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
     * Set motif
     *
     * @param string $motif
     *
     * @return Commande
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
     * Set modifiable
     *
     * @param boolean $modifiable
     *
     * @return Commande
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
     * Constructor
     */
    public function __construct()
    {
        $this->ligneCommandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userConfirmes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etat = 'En cour de création';
        $this->modifiable = true;
    }

    /**
     * Add ligneCommande
     *
     * @param \GestionBundle\Entity\ligneCommande $ligneCommande
     *
     * @return Commande
     */
    public function addLigneCommande(\GestionBundle\Entity\ligneCommande $ligneCommande)
    {
        $this->ligneCommandes[] = $ligneCommande;

        return $this;
    }

    /**
     * Remove ligneCommande
     *
     * @param \GestionBundle\Entity\ligneCommande $ligneCommande
     */
    public function removeLigneCommande(\GestionBundle\Entity\ligneCommande $ligneCommande)
    {
        $this->ligneCommandes->removeElement($ligneCommande);
    }

    /**
     * Get ligneCommandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneCommandes()
    {
        return $this->ligneCommandes;
    }

    /**
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return Commande
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
     * Add userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return Commande
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
     * @return Commande
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
     * Set fournisseur
     *
     * @param \FournisseurBundle\Entity\Fournisseur $fournisseur
     *
     * @return Commande
     */
    public function setFournisseur(\FournisseurBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \FournisseurBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Commande
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
}
