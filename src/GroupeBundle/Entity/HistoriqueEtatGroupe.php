<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueEtatGroupe
 *
 * @ORM\Table(name="historique_etat_groupe")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\HistoriqueEtatGroupeRepository")
 */
class HistoriqueEtatGroupe
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

    //---------------------------  RELATION  -------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\ListeEtatGroupe")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\GroupageHistoriqueGroupe", inversedBy="historiqueEtatGroupes")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupageHist;

    //-----------------------------/// RELATION ///-----------------------------


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
     * @return HistoriqueEtatGroupe
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
     * @return HistoriqueEtatGroupe
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
     * Set etat
     *
     * @param \GroupeBundle\Entity\ListeEtatGroupe $etat
     *
     * @return HistoriqueEtatGroupe
     */
    public function setEtat(\GroupeBundle\Entity\ListeEtatGroupe $etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \GroupeBundle\Entity\ListeEtatGroupe
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set groupageHist
     *
     * @param \GroupeBundle\Entity\GroupageHistoriqueGroupe $groupageHist
     *
     * @return HistoriqueEtatGroupe
     */
    public function setGroupageHist(\GroupeBundle\Entity\GroupageHistoriqueGroupe $groupageHist)
    {
        $this->groupageHist = $groupageHist;

        return $this;
    }

    /**
     * Get groupageHist
     *
     * @return \GroupeBundle\Entity\GroupageHistoriqueGroupe
     */
    public function getGroupageHist()
    {
        return $this->groupageHist;
    }

    /**
     * Set site
     *
     * @param \GroupeBundle\Entity\Site $site
     *
     * @return HistoriqueEtatGroupe
     */
    public function setSite(\GroupeBundle\Entity\Site $site)
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
}
