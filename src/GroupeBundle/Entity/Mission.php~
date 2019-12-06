<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mission
 *
 * @ORM\Table(name="mission")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\MissionRepository")
 */
class Mission
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
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="note_fin", type="text", nullable=true)
     */
    private $noteFin;




    //-----------------------------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Probleme")
     * @ORM\JoinColumn(nullable=true)
     */
    private $probleme;

    /**
     * @ORM\OneToMany(targetEntity="GroupeBundle\Entity\EmployeMission", mappedBy="mission")
     */
    private $employeMissions; // Notez le « s », un stocks est liée à plusieurs ligne




    //-----------------------------------------------------



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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Mission
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Mission
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Mission
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employeMissions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set noteFin
     *
     * @param string $noteFin
     *
     * @return Mission
     */
    public function setNoteFin($noteFin)
    {
        $this->noteFin = $noteFin;

        return $this;
    }

    /**
     * Get noteFin
     *
     * @return string
     */
    public function getNoteFin()
    {
        return $this->noteFin;
    }

    /**
     * Set site
     *
     * @param \GroupeBundle\Entity\Site $site
     *
     * @return Mission
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

    /**
     * Set probleme
     *
     * @param \GroupeBundle\Entity\Probleme $probleme
     *
     * @return Mission
     */
    public function setProbleme(\GroupeBundle\Entity\Probleme $probleme = null)
    {
        $this->probleme = $probleme;

        return $this;
    }

    /**
     * Get probleme
     *
     * @return \GroupeBundle\Entity\Probleme
     */
    public function getProbleme()
    {
        return $this->probleme;
    }

    /**
     * Add employeMission
     *
     * @param \GroupeBundle\Entity\EmployeMission $employeMission
     *
     * @return Mission
     */
    public function addEmployeMission(\GroupeBundle\Entity\EmployeMission $employeMission)
    {
        $this->employeMissions[] = $employeMission;

        return $this;
    }

    /**
     * Remove employeMission
     *
     * @param \GroupeBundle\Entity\EmployeMission $employeMission
     */
    public function removeEmployeMission(\GroupeBundle\Entity\EmployeMission $employeMission)
    {
        $this->employeMissions->removeElement($employeMission);
    }

    /**
     * Get employeMissions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployeMissions()
    {
        return $this->employeMissions;
    }
}
