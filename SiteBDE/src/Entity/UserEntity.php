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
