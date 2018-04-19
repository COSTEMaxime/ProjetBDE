<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoEntityRepository")
 */
class PhotoEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nblike;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFlagged;

    /**
     * @ORM\Column(type="integer")
     */
    private $ID_like;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDuser;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDphoto;


    /**
     * @ORM\OneToMany(targetEntity="PhotoLikeEntity")
     * @ORM\JoinColumn(name="$photoLike_id", referencedColumnName="id")
     */
    private $photoLike_id;

    /**
     * @ORM\OneToOne(targetEntity="ActiviteEntity")
     * @ORM\JoinColumn(name="$activite_id", referencedColumnName="id")
     */
    private $activite_id;



    public function getId()
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getNblike(): ?int
    {
        return $this->nblike;
    }

    public function setNblike(?int $nblike): self
    {
        $this->nblike = $nblike;

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

    public function getIDLike(): ?int
    {
        return $this->ID_like;
    }

    public function setIDLike(int $ID_like): self
    {
        $this->ID_like = $ID_like;

        return $this;
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

    public function getIDphoto(): ?int
    {
        return $this->IDphoto;
    }

    public function setIDphoto(int $IDphoto): self
    {
        $this->IDphoto = $IDphoto;

        return $this;
    }
}
