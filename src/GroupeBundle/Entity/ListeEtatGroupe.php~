<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListeEtatGroupe
 *
 * @ORM\Table(name="liste_etat_groupe")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\ListeEtatGroupeRepository")
 */
class ListeEtatGroupe
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
     * @ORM\Column(name="etat", type="string", length=100)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=100, nullable=true)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur_css", type="string", length=100, nullable=true)
     */
    private $couleurCss;


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
     * Set etat
     *
     * @param string $etat
     *
     * @return ListeEtatGroupe
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return ListeEtatGroupe
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set couleurCss
     *
     * @param string $couleurCss
     *
     * @return ListeEtatGroupe
     */
    public function setCouleurCss($couleurCss)
    {
        $this->couleurCss = $couleurCss;

        return $this;
    }

    /**
     * Get couleurCss
     *
     * @return string
     */
    public function getCouleurCss()
    {
        return $this->couleurCss;
    }
}
