<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeplacementGroupe
 *
 * @ORM\Table(name="deplacement_groupe")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\DeplacementGroupeRepository")
 */
class DeplacementGroupe
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    //-----------------------------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site")
     * @ORM\JoinColumn(nullable=false)
     */
    private $siteDepart;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site")
     * @ORM\JoinColumn(nullable=false)
     */
    private $siteDestination;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return DeplacementGroupe
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
     * Set siteDepart
     *
     * @param \GroupeBundle\Entity\Site $siteDepart
     *
     * @return DeplacementGroupe
     */
    public function setSiteDepart(\GroupeBundle\Entity\Site $siteDepart)
    {
        $this->siteDepart = $siteDepart;

        return $this;
    }

    /**
     * Get siteDepart
     *
     * @return \GroupeBundle\Entity\Site
     */
    public function getSiteDepart()
    {
        return $this->siteDepart;
    }

    /**
     * Set siteDestination
     *
     * @param \GroupeBundle\Entity\Site $siteDestination
     *
     * @return DeplacementGroupe
     */
    public function setSiteDestination(\GroupeBundle\Entity\Site $siteDestination)
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
     * Set description
     *
     * @param string $description
     *
     * @return DeplacementGroupe
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
}
