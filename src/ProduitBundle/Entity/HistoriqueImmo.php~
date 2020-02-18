<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueImmo
 *
 * @ORM\Table(name="historique_immo")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\HistoriqueImmoRepository")
 */
class HistoriqueImmo
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
     * @ORM\Column(name="motif", type="string", length=250)
     */
    private $motif;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    // ------------------- RELATION ---------------------

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Immo", inversedBy="historiqueImmos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $immo;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Depot", inversedBy="historiqueImmos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $depot;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Site", inversedBy="historiqueImmos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $site;

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
     * @return HistoriqueImmo
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
     * Set motif
     *
     * @param string $motif
     *
     * @return HistoriqueImmo
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
     * Set description
     *
     * @param string $description
     *
     * @return HistoriqueImmo
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
     * Set immo
     *
     * @param \ProduitBundle\Entity\Immo $immo
     *
     * @return HistoriqueImmo
     */
    public function setImmo(\ProduitBundle\Entity\Immo $immo)
    {
        $this->immo = $immo;

        return $this;
    }

    /**
     * Get immo
     *
     * @return \ProduitBundle\Entity\Immo
     */
    public function getImmo()
    {
        return $this->immo;
    }

    /**
     * Set depot
     *
     * @param \ProduitBundle\Entity\Depot $depot
     *
     * @return HistoriqueImmo
     */
    public function setDepot(\ProduitBundle\Entity\Depot $depot = null)
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
     * Set site
     *
     * @param \GroupeBundle\Entity\Site $site
     *
     * @return HistoriqueImmo
     */
    public function setSite(\GroupeBundle\Entity\Site $site = null)
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
