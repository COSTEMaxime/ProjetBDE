<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserEntityRepository")
 */
class UserEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     *
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     *
     */

    private $mail;

    /**
     * @ORM\Column(type="string", length=50)
     *
     */

    private $mdp;

    /**
     * @ORM\Column(type="integer")
     *
     */

    private $IDStatus;

    /**
     * @ORM\OneToMany(targetEntity="InscritManifestationEntity")
     * @ORM\JoinColumn(name="$manifestation_id", referencedColumnName="id")
     */
    private $manifestation_id;

    /**
     * @ORM\OneToOne(targetEntity="StatusUserEntity")
     * @ORM\JoinColumn(name="$status_id", referencedColumnName="id")
     */
    private $status_id;

    /**
     * @ORM\OneToMany(targetEntity="CommentEntity")
     * @ORM\JoinColumn(name="$comment_id", referencedColumnName="id")
     */
    private $comment_id;

    /**
     * @ORM\OneToMany(targetEntity="CommentLikeEntity")
     * @ORM\JoinColumn(name="$commentLike_id", referencedColumnName="id")
     */
    private $commentLike_id;

    /**
     * @ORM\OneToMany(targetEntity="LikeEntity")
     * @ORM\JoinColumn(name="$Like_id", referencedColumnName="id")
     */
    private $Like_id;



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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }
    public function getIDStatus(): ?int
    {
        return $this->IDStatus;
    }

    public function setIDStatus(int $IDStatus): self
    {
        $this->IDStatus = $IDStatus;

        return $this;
    }
}
