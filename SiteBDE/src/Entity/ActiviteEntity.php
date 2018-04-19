<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteEntityRepository")
 */
class ActiviteEntity
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDphoto;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDuser;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbLike;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDislike;

    /**
     * @ORM\OneToOne(targetEntity="ManifestationEntity")
     * @ORM\JoinColumn(name="$manifestaton_id", referencedColumnName="id")
     */
    private $manifestaton_id;


    /**
     * @ORM\OneToMany(targetEntity="CommentEntity")
     * @ORM\JoinColumn(name="$comment_id", referencedColumnName="id")
     */
    private $comment_id;

    /**
     * @ORM\OneToMany(targetEntity="PhotoEntity")
     * @ORM\JoinColumn(name="$photo_id", referencedColumnName="id")
     */
    private $photo_id;

    /**
     * @ORM\OneToMany(targetEntity="LikeEntity")
     * @ORM\JoinColumn(name="$Like_id", referencedColumnName="id")
     */
    private $like_id;


    public function getId()
    {
        return $this->id;
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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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

    public function getIDuser(): ?int
    {
        return $this->IDuser;
    }

    public function setIDuser(int $IDuser): self
    {
        $this->IDuser = $IDuser;

        return $this;
    }

    public function getNbLike(): ?int
    {
        return $this->nbLike;
    }

    public function setNbLike(int $nbLike): self
    {
        $this->nbLike = $nbLike;

        return $this;
    }

    public function getNbDislike(): ?int
    {
        return $this->nbDislike;
    }

    public function setNbDislike(int $nbDislike): self
    {
        $this->nbDislike = $nbDislike;

        return $this;
    }
}
