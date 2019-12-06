<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NombreConfirmation
 *
 * @ORM\Table(name="nombre_confirmation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\NombreConfirmationRepository")
 */
class NombreConfirmation
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
     * @ORM\Column(name="nomDemande", type="string", length=100, unique=true)
     */
    private $nomDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre", type="integer")
     */
    private $nombre;


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
     * Set nomDemande
     *
     * @param string $nomDemande
     *
     * @return NombreConfirmation
     */
    public function setNomDemande($nomDemande)
    {
        $this->nomDemande = $nomDemande;

        return $this;
    }

    /**
     * Get nomDemande
     *
     * @return string
     */
    public function getNomDemande()
    {
        return $this->nomDemande;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     *
     * @return NombreConfirmation
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return int
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}

