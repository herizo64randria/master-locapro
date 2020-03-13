<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appoint
 *
 * @ORM\Table(name="appoint")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\AppointRepository")
 */
class Appoint
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
     * @var float
     *
     * @ORM\Column(name="huile_utilise", type="float", nullable=true)
     */
    private $huileUtilise;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


//------------\\\\\\\////////////-----------

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupe;


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
     * @return Appoint
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
     * Set huileUtilise
     *
     * @param float $huileUtilise
     *
     * @return Appoint
     */
    public function setHuileUtilise($huileUtilise)
    {
        $this->huileUtilise = $huileUtilise;

        return $this;
    }

    /**
     * Get huileUtilise
     *
     * @return float
     */
    public function getHuileUtilise()
    {
        return $this->huileUtilise;
    }

    /**
     * Set groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return Appoint
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
     * Set description
     *
     * @param string $description
     *
     * @return Appoint
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
