<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitEntityRepository")
 */
class ProduitEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDeFois;

    /**
     * @ORM\Column(type="integer")
     */
    private $idPhoto;

    public function getIdPhoto()
    {
        return $this->idPhoto;
    }

    public function setIdPhoto($idPhoto): void
    {
        $this->idPhoto = $idPhoto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNbDeFois(): ?int
    {
        return $this->nbDeFois;
    }

    public function setNbDeFois(int $nbDeFois): self
    {
        $this->nbDeFois = $nbDeFois;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id'            =>      $this->id,
            'nom'           =>      $this->nom,
            'description'   =>      $this->description,
            'prix'          =>      $this->prix,
            'type'          =>      $this->type,
            'nbDeFois'      =>      $this->type,
            'idPhoto'       =>      $this->idPhoto
        ];
    }
}
