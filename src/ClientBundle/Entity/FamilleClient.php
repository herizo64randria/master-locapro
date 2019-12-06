<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FamilleClient
 *
 * @ORM\Table(name="famille_client")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\FamilleClientRepository")
 */
class FamilleClient
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="champ1", type="string", length=255, nullable=true)
     */
    private $champ1;

    /**
     * @var string
     *
     * @ORM\Column(name="champ2", type="string", length=255, nullable=true)
     */
    private $champ2;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return FamilleClient
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
     * Set champ1
     *
     * @param string $champ1
     *
     * @return FamilleClient
     */
    public function setChamp1($champ1)
    {
        $this->champ1 = $champ1;

        return $this;
    }

    /**
     * Get champ1
     *
     * @return string
     */
    public function getChamp1()
    {
        return $this->champ1;
    }

    /**
     * Set champ2
     *
     * @param string $champ2
     *
     * @return FamilleClient
     */
    public function setChamp2($champ2)
    {
        $this->champ2 = $champ2;

        return $this;
    }

    /**
     * Get champ2
     *
     * @return string
     */
    public function getChamp2()
    {
        return $this->champ2;
    }
}

