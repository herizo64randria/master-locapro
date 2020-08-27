<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupageHistoriqueGroupe
 *
 * @ORM\Table(name="groupage_historique_groupe")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\GroupageHistoriqueGroupeRepository")
 */
class GroupageHistoriqueGroupe
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
     * @ORM\Column(name="dateString", type="string", length=255, unique=true)
     */
    private $dateString;

    //---------------------------  RELATIONS  -------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GroupeBundle\Entity\HistoriqueEtatGroupe", mappedBy="groupageHist")
     */
    private $historiqueEtatGroupes; // Notez le « s », un stocks est liée à plusieurs ligne

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
     * Set dateString
     *
     * @param string $dateString
     *
     * @return GroupageHistoriqueGroupe
     */
    public function setDateString($dateString)
    {
        $this->dateString = $dateString;

        return $this;
    }

    /**
     * Get dateString
     *
     * @return string
     */
    public function getDateString()
    {
        return $this->dateString;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historiqueEtatGroupes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add historiqueEtatGroupe
     *
     * @param \GroupeBundle\Entity\HistoriqueEtatGroupe $historiqueEtatGroupe
     *
     * @return GroupageHistoriqueGroupe
     */
    public function addHistoriqueEtatGroupe(\GroupeBundle\Entity\HistoriqueEtatGroupe $historiqueEtatGroupe)
    {
        $this->historiqueEtatGroupes[] = $historiqueEtatGroupe;

        return $this;
    }

    /**
     * Remove historiqueEtatGroupe
     *
     * @param \GroupeBundle\Entity\HistoriqueEtatGroupe $historiqueEtatGroupe
     */
    public function removeHistoriqueEtatGroupe(\GroupeBundle\Entity\HistoriqueEtatGroupe $historiqueEtatGroupe)
    {
        $this->historiqueEtatGroupes->removeElement($historiqueEtatGroupe);
    }

    /**
     * Get historiqueEtatGroupes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoriqueEtatGroupes()
    {
        return $this->historiqueEtatGroupes;
    }
}
