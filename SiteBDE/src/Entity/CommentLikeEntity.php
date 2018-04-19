<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentLikeEntityRepository")
 */
class CommentLikeEntity
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
    private $ID_commentaire;


    /**
     * @ORM\OneToOne(targetEntity="CommentEntity")
     * @ORM\JoinColumn(name="$comment_id", referencedColumnName="id")
     */
    private $comment_id;

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

    public function getIDCommentaire(): ?int
    {
        return $this->ID_commentaire;
    }

    public function setIDCommentaire(int $ID_commentaire): self
    {
        $this->ID_commentaire = $ID_commentaire;

        return $this;
    }
}
