<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Huile
 *
 * @ORM\Table(name="huile")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\HuileRepository")
 */
class Huile
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
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var float
     *
     * @ORM\Column(name="prixAchat", type="float", nullable=true)
     */
    private $prixAchat;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_total", type="integer", nullable=true)
     */
    private $stockTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="alert", type="integer", nullable=true)
     */
    private $alert;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;


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
     * Set designation
     *
     * @param string $designation
     *
     * @return Huile
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Huile
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set prixAchat
     *
     * @param float $prixAchat
     *
     * @return Huile
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return float
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set stockTotal
     *
     * @param integer $stockTotal
     *
     * @return Huile
     */
    public function setStockTotal($stockTotal)
    {
        $this->stockTotal = $stockTotal;

        return $this;
    }

    /**
     * Get stockTotal
     *
     * @return integer
     */
    public function getStockTotal()
    {
        return $this->stockTotal;
    }

    /**
     * Set alert
     *
     * @param integer $alert
     *
     * @return Huile
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;

        return $this;
    }

    /**
     * Get alert
     *
     * @return integer
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Huile
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}
