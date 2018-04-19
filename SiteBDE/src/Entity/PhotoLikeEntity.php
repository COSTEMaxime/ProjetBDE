<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoLikeEntityRepository")
 */
class PhotoLikeEntity
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
    private $IDphoto;


    /**
     * @ORM\OneToOne(targetEntity="PhotoEntity")
     * @ORM\JoinColumn(name="$photo_id", referencedColumnName="id")
     */
    private $photo_id;

    /**
     * @ORM\OneToOne(targetEntity="UserEntity")
     * @ORM\JoinColumn(name="$user_id", referencedColumnName="id")
     */
    private $user_id;

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
