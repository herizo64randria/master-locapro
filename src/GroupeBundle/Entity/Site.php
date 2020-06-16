<?php

namespace GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="GroupeBundle\Repository\SiteRepository")
 */
class Site
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
     * @ORM\Column(name="emplacement", type="string", length=100)
     */
    private $emplacement;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255, nullable=true)
     */
    private $couleur;

    /**
     * @var array
     *
     * @ORM\Column(name="coords", type="array")
     */
    private $coords;

//------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="GroupeBundle\Entity\Groupe", mappedBy="site")
     */
    private $groupes; // Notez le « s », un stocks est liée à plusieurs ligne

    /**
     * @ORM\OneToMany(targetEntity="ProduitBundle\Entity\HistoriqueImmo", mappedBy="site")
     */
    private $historiqueImmos; // Notez le « s », il y a plusieur historique

    /**
     * @ORM\OneToMany(targetEntity="ProduitBundle\Entity\Immo", mappedBy="site")
     */
    private $immos; // Notez le « s », il y a plusieur historique

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Entre", mappedBy="site")
     */
    private $Entres; // Notez le « s », un stocks est liée à plusieurs entrées

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Sortie", mappedBy="site")
     */
    private $sorties; // Notez le « s », un stocks est liée à plusieurs entrées

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Deplacement", mappedBy="sourcesite")
     */
    private $sourcedeplacements; // Notez le « s », un stocks est liée à plusieurs entrées

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\Deplacement", mappedBy="destinationsite")
     */
    private $destinationdeplacements; // Notez le « s », un stocks est liée à plusieurs entrées

    /**
     * @ORM\OneToMany(targetEntity="GestionBundle\Entity\BonExpedition", mappedBy="site")
     */
    private $bonExpeditions; // Notez le « s », un stocks est liée à plusieurs entrées


//------------------------------------------

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
     * Set emplacement
     *
     * @param string $emplacement
     *
     * @return Site
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return string
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set coords
     *
     * @param array $coords
     *
     * @return Site
     */
    public function setCoords($coords)
    {
        $this->coords = $coords;

        return $this;
    }

    /**
     * Get coords
     *
     * @return array
     */
    public function getCoords()
    {
        return $this->coords;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     *
     * @return Site
     */
    public function addGroupe(\GroupeBundle\Entity\Groupe $groupe)
    {
        $this->groupes[] = $groupe;

        return $this;
    }

    /**
     * Remove groupe
     *
     * @param \GroupeBundle\Entity\Groupe $groupe
     */
    public function removeGroupe(\GroupeBundle\Entity\Groupe $groupe)
    {
        $this->groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupes()
    {
        return $this->groupes;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Site
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
     * Add historiqueImmo
     *
     * @param \ProduitBundle\Entity\HistoriqueImmo $historiqueImmo
     *
     * @return Site
     */
    public function addHistoriqueImmo(\ProduitBundle\Entity\HistoriqueImmo $historiqueImmo)
    {
        $this->historiqueImmos[] = $historiqueImmo;

        return $this;
    }

    /**
     * Remove historiqueImmo
     *
     * @param \ProduitBundle\Entity\HistoriqueImmo $historiqueImmo
     */
    public function removeHistoriqueImmo(\ProduitBundle\Entity\HistoriqueImmo $historiqueImmo)
    {
        $this->historiqueImmos->removeElement($historiqueImmo);
    }

    /**
     * Get historiqueImmos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoriqueImmos()
    {
        return $this->historiqueImmos;
    }

    /**
     * Add immo
     *
     * @param \ProduitBundle\Entity\Immo $immo
     *
     * @return Site
     */
    public function addImmo(\ProduitBundle\Entity\Immo $immo)
    {
        $this->immos[] = $immo;

        return $this;
    }

    /**
     * Remove immo
     *
     * @param \ProduitBundle\Entity\Immo $immo
     */
    public function removeImmo(\ProduitBundle\Entity\Immo $immo)
    {
        $this->immos->removeElement($immo);
    }

    /**
     * Get immos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImmos()
    {
        return $this->immos;
    }

    /**
     * Add entre
     *
     * @param \GestionBundle\Entity\Entre $entre
     *
     * @return Site
     */
    public function addEntre(\GestionBundle\Entity\Entre $entre)
    {
        $this->Entres[] = $entre;

        return $this;
    }

    /**
     * Remove entre
     *
     * @param \GestionBundle\Entity\Entre $entre
     */
    public function removeEntre(\GestionBundle\Entity\Entre $entre)
    {
        $this->Entres->removeElement($entre);
    }

    /**
     * Get entres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntres()
    {
        return $this->Entres;
    }

    /**
     * Add sorty
     *
     * @param \GestionBundle\Entity\Sortie $sorty
     *
     * @return Site
     */
    public function addSorty(\GestionBundle\Entity\Sortie $sorty)
    {
        $this->sorties[] = $sorty;

        return $this;
    }

    /**
     * Remove sorty
     *
     * @param \GestionBundle\Entity\Sortie $sorty
     */
    public function removeSorty(\GestionBundle\Entity\Sortie $sorty)
    {
        $this->sorties->removeElement($sorty);
    }

    /**
     * Get sorties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSorties()
    {
        return $this->sorties;
    }

    /**
     * Add sourcedeplacement
     *
     * @param \GestionBundle\Entity\Deplacement $sourcedeplacement
     *
     * @return Site
     */
    public function addSourcedeplacement(\GestionBundle\Entity\Deplacement $sourcedeplacement)
    {
        $this->sourcedeplacements[] = $sourcedeplacement;

        return $this;
    }

    /**
     * Remove sourcedeplacement
     *
     * @param \GestionBundle\Entity\Deplacement $sourcedeplacement
     */
    public function removeSourcedeplacement(\GestionBundle\Entity\Deplacement $sourcedeplacement)
    {
        $this->sourcedeplacements->removeElement($sourcedeplacement);
    }

    /**
     * Get sourcedeplacements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSourcedeplacements()
    {
        return $this->sourcedeplacements;
    }

    /**
     * Add destinationdeplacement
     *
     * @param \GestionBundle\Entity\Deplacement $destinationdeplacement
     *
     * @return Site
     */
    public function addDestinationdeplacement(\GestionBundle\Entity\Deplacement $destinationdeplacement)
    {
        $this->destinationdeplacements[] = $destinationdeplacement;

        return $this;
    }

    /**
     * Remove destinationdeplacement
     *
     * @param \GestionBundle\Entity\Deplacement $destinationdeplacement
     */
    public function removeDestinationdeplacement(\GestionBundle\Entity\Deplacement $destinationdeplacement)
    {
        $this->destinationdeplacements->removeElement($destinationdeplacement);
    }

    /**
     * Get destinationdeplacements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestinationdeplacements()
    {
        return $this->destinationdeplacements;
    }
}
