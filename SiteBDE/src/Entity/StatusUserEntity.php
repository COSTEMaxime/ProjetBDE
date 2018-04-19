<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusUserEntityRepository")
 */
class StatusUserEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="UserEntity")
     * @ORM\JoinColumn(name="$status_id", referencedColumnName="id")
     */
    private $status_id;

    public function getId()
    {
        return $this->id;
    }
}
