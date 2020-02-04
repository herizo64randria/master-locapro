<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueGlobal
 *
 * @ORM\Table(name="historique_global")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\HistoriqueGlobalRepository")
 */
class HistoriqueGlobal
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
     * @ORM\Column(name="libelle", type="text")
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="text")
     */
    private $lien;

    /**
     * @var array
     *
     * @ORM\Column(name="modification", type="array", nullable=true)
     */
    private $modification;

    //-------------

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userHistorique;

    //--------------

    // ------------------- CONTRUCTOR ---------------------

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    // ------------------- ////// CONTRUCTOR ////// ---------------------

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
     * @return HistoriqueGlobal
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return HistoriqueGlobal
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
     * Set lien
     *
     * @param string $lien
     *
     * @return HistoriqueGlobal
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set modification
     *
     * @param array $modification
     *
     * @return HistoriqueGlobal
     */
    public function setModification($modification)
    {
        $this->modification = $modification;

        return $this;
    }

    /**
     * Get modification
     *
     * @return array
     */
    public function getModification()
    {
        return $this->modification;
    }

    /**
     * Set userHistorique
     *
     * @param \UserBundle\Entity\User $userHistorique
     *
     * @return HistoriqueGlobal
     */
    public function setUserHistorique(\UserBundle\Entity\User $userHistorique)
    {
        $this->userHistorique = $userHistorique;

        return $this;
    }

    /**
     * Get userHistorique
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserHistorique()
    {
        return $this->userHistorique;
    }
}
