<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeEntityRepository")
 */
class LikeEntity
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
    private $IDActivite;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDUser;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLike;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDisliked;


    /**
     * @ORM\OneToOne(targetEntity="ActiviteEntity")
     * @ORM\JoinColumn(name="$Activite_id", referencedColumnName="id")
     */
    private $activite_id;
    /**
     * @ORM\OneToOne(targetEntity="UserEntity")
     * @ORM\JoinColumn(name="$User_id", referencedColumnName="id")
     */
    private $user_id;


    public function getId()
    {
        return $this->id;
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

    public function getIDUser(): ?int
    {
        return $this->IDUser;
    }

    public function setIDUser(int $IDUser): self
    {
        $this->IDUser = $IDUser;

        return $this;
    }

    public function getIsLike(): ?bool
    {
        return $this->isLike;
    }

    public function setIsLike(bool $isLike): self
    {
        $this->isLike = $isLike;

        return $this;
    }

    public function getIsDisliked(): ?bool
    {
        return $this->isDisliked;
    }

    public function setIsDisliked(bool $isDisliked): self
    {
        $this->isDisliked = $isDisliked;

        return $this;
    }
}
