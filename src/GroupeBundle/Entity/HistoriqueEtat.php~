<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueEtat
 *
 * @ORM\Table(name="historique_etat")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\HistoriqueEtatRepository")
 */
class HistoriqueEtat
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
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;


//------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupe;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\Probleme", inversedBy="historiqueArret")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $problemeArret;

    /**
     * @ORM\OneToOne(targetEntity="GroupeBundle\Entity\Probleme", inversedBy="historiqueeDemarrer")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $problemeDemarrer;


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
     * @return HistoriqueEtat
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
     * Set statut
     *
     * @param string $statut
     *
     * @return HistoriqueEtat
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return HistoriqueEtat
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return HistoriqueEtat
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
     * Set problemeArret
     *
     * @param \GroupeBundle\Entity\Probleme $problemeArret
     *
     * @return HistoriqueEtat
     */
    public function setProblemeArret(\GroupeBundle\Entity\Probleme $problemeArret = null)
    {
        $this->problemeArret = $problemeArret;

        return $this;
    }

    /**
     * Get problemeArret
     *
     * @return \GroupeBundle\Entity\Probleme
     */
    public function getProblemeArret()
    {
        return $this->problemeArret;
    }

    /**
     * Set problemeDemarrer
     *
     * @param \GroupeBundle\Entity\Probleme $problemeDemarrer
     *
     * @return HistoriqueEtat
     */
    public function setProblemeDemarrer(\GroupeBundle\Entity\Probleme $problemeDemarrer = null)
    {
        $this->problemeDemarrer = $problemeDemarrer;

        return $this;
    }

    /**
     * Get problemeDemarrer
     *
     * @return \GroupeBundle\Entity\Probleme
     */
    public function getProblemeDemarrer()
    {
        return $this->problemeDemarrer;
    }
}
