<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PjCatalogue
 *
 * @ORM\Table(name="pj_catalogue")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\PjCatalogueRepository")
 */
class PjCatalogue
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
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="ext", type="string", length=255, nullable=true)
     */
    private $ext;

    /**
     * @ORM\ManyToOne(targetEntity="GroupeBundle\Entity\Catalogue",inversedBy="pjcatalogue")
     * @ORM\JoinColumn(nullable=true)
     */
    private $catalogue;

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
     * Set lien
     *
     * @param string $lien
     *
     * @return PjCatalogue
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
     * Set catalogue
     *
     * @param \GroupeBundle\Entity\Catalogue $catalogue
     *
     * @return PjCatalogue
     */
    public function setCatalogue(\GroupeBundle\Entity\Catalogue $catalogue = null)
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    /**
     * Get catalogue
     *
     * @return \GroupeBundle\Entity\Catalogue
     */
    public function getCatalogue()
    {
        return $this->catalogue;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return PjCatalogue
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set ext
     *
     * @param string $ext
     *
     * @return PjCatalogue
     */
    public function setExt($ext)
    {
        $this->ext = $ext;

        return $this;
    }

    /**
     * Get ext
     *
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }
}
