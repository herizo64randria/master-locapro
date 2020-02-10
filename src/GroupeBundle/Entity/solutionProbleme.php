<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * solutionProbleme
 *
 * @ORM\Table(name="solution_probleme")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\solutionProblemeRepository")
 */
class solutionProbleme
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
     * @ORM\Column(name="solution", type="text")
     */
    private $solution;

    // ------------------- RELATION ---------------------

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userSolution;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Probleme", inversedBy="ligneSolutions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $probleme;



    // ------------------- ////// RELATION ////// ---------------------


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
     * @return solutionProbleme
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
     * Set solution
     *
     * @param string $solution
     *
     * @return solutionProbleme
     */
    public function setSolution($solution)
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * Get solution
     *
     * @return string
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * Set userSolution
     *
     * @param \UserBundle\Entity\User $userSolution
     *
     * @return solutionProbleme
     */
    public function setUserSolution(\UserBundle\Entity\User $userSolution)
    {
        $this->userSolution = $userSolution;

        return $this;
    }

    /**
     * Get userSolution
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserSolution()
    {
        return $this->userSolution;
    }

    /**
     * Set probleme
     *
     * @param \GroupeBundle\Entity\Probleme $probleme
     *
     * @return solutionProbleme
     */
    public function setProbleme(\GroupeBundle\Entity\Probleme $probleme)
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
}
