<?php

namespace App\Repository;

use App\Entity\ActiviteEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ActiviteEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActiviteEntity::class);
    }

    public function findAllLimit($limit)
    {
        return $this->findBy(array(), array('id' => 'DESC'), $limit, null);
    }
}
