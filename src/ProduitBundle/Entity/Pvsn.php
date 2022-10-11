<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * pvsn
 *
 * @ORM\Table(name="pv_sn")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\pvsnRepository")
 */
class Pvsn
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
     * @ORM\Column(name="numero_de_serie", type="string", length=255, unique=true)
     */
    private $numeroSerie;


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
     * @return string
     */
    public function getNumeroSerie()
    {
        return $this->numeroSerie;
    }

    /**
     * @param string $numeroSerie
     */
    public function setNumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;
    }

    public function __toString(): string 
    {
        return $this->getNumeroSerie();
    }

}

