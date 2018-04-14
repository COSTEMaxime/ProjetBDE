<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManifestationEntityRepository")
 */
class ManifestationEntity
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
    private $IDuser;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDActivite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\Column(type="date")
     */
    private $DateManifestation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeRecurrence;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFlagged;

    public function getId()
    {
        return $this->id;
    }

    public function getIDuser(): ?int
    {
        return $this->IDuser;
    }

    public function setIDuser(int $IDuser): self
    {
        $this->IDuser = $IDuser;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIDActivite(): ?int
    {
        return $this->IDActivite;
    }

    public function setIDActivite(int $IDActivite): self
    {
        $this->IDActivite = $IDActivite;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateManifestation(): ?string
    {
        return $this->DateManifestation;
    }

    public function setDateManifestation(string $DateManifestation): self
    {
        $this->DateManifestation = $DateManifestation;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTypeRecurrence(): ?string
    {
        return $this->typeRecurrence;
    }

    public function setTypeRecurrence(string $typeRecurrence): self
    {
        $this->typeRecurrence = $typeRecurrence;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIsFlagged(): ?bool
    {
        return $this->isFlagged;
    }

    public function setIsFlagged(bool $isFlagged): self
    {
        $this->isFlagged = $isFlagged;

        return $this;
    }
}
