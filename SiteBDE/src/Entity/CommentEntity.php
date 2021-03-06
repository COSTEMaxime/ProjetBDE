<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentEntityRepository")
 */
class CommentEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateComment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsFlagged;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdLike;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdParent;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdPhoto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    public function getId()
    {
        return $this->id;
    }

    public function getDateComment()
    {
        return $this->dateComment;
    }

    public function setDateComment($dateComment): self
    {
        $this->dateComment = $dateComment;

        return $this;
    }

    public function getIsFlagged(): ?bool
    {
        return $this->IsFlagged;
    }

    public function setIsFlagged(bool $IsFlagged): self
    {
        $this->IsFlagged = $IsFlagged;

        return $this;
    }

    public function getIdLike(): ?int
    {
        return $this->IdLike;
    }

    public function setIdLike(int $IdLike): self
    {
        $this->IdLike = $IdLike;

        return $this;
    }

    public function getIdParent(): ?int
    {
        return $this->IdParent;
    }

    public function setIdParent(int $IdParent): self
    {
        $this->IdParent = $IdParent;

        return $this;
    }

    public function getIdPhoto(): ?int
    {
        return $this->IdPhoto;
    }

    public function setIdPhoto(int $IdPhoto): self
    {
        $this->IdPhoto = $IdPhoto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }


}
