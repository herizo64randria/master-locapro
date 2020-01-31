<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entre
 *
 * @ORM\Table(name="entre")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\EntreRepository")
 */
class Entre
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
//------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\ligneEntre", mappedBy="entre")
     */
    private $ligneEntres; // Notez le « s », un stocks est liée à plusieurs ligne

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCreer;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Depot", inversedBy="Entres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $depot;
    /**
     * @ORM\ManyToOne(targetEntity="FournisseurBundle\Entity\Fournisseur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $fournisseur;
    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", cascade={"persist"})
     */
    private $userConfirmes;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userRefuser;
//------------------------------------------////////////////////


    public function __construct()
    {
        $this->ligneEntres = new \Doctrine\Common\Collections\ArrayCollection();

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
     * @return Entre
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
     * @return Entre
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
     * @return Entre
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
     * @return Entre
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
     * @return Entre
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
     * Add ligneEntre
     *
     * @param \GestionBundle\Entity\ligneEntre $ligneEntre
     *
     * @return Entre
     */
    public function addLigneEntre(\GestionBundle\Entity\ligneEntre $ligneEntre)
    {
        $this->ligneEntres[] = $ligneEntre;

        return $this;
    }

    /**
     * Remove ligneEntre
     *
     * @param \GestionBundle\Entity\ligneEntre $ligneEntre
     */
    public function removeLigneEntre(\GestionBundle\Entity\ligneEntre $ligneEntre)
    {
        $this->ligneEntres->removeElement($ligneEntre);
    }

    /**
     * Get ligneEntres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneEntres()
    {
        return $this->ligneEntres;
    }

    /**
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return Entre
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
     * @return Entre
     */
    public function setDepot(\ProduitBundle\Entity\Depot $depot)
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
     * Set fournisseur
     *
     * @param \FournisseurBundle\Entity\Fournisseur $fournisseur
     *
     * @return Entre
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
     * @return Entre
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
     * Add userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return Entre
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
     * @return Entre
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
     * Set dateOperation
     *
     * @param \DateTime $dateOperation
     *
     * @return Entre
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
}
