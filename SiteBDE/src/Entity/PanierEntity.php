<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierEntityRepository")
 */
class PanierEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDproduit;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    public function getId()
    {
        return $this->id;
    }

    public function getIDproduit(): ?int
    {
        return $this->IDproduit;
    }

    public function setIDproduit(int $IDproduit): self
    {
        $this->IDproduit = $IDproduit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
