<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscritManifestationEntityRepository")
 */
class InscritManifestationEntity
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
     * @ORM\Column(type="integer")
     */
    private $IDManifestation;

    public function getIDManifestation()
    {
        return $this->IDManifestation;
    }

    public function setIDManifestation($IDManifestation): void
    {
        $this->IDManifestation = $IDManifestation;
    }

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
}
