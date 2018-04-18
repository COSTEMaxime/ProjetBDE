<?php

namespace App\Repository;

use App\Entity\ManifestationEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ManifestationEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ManifestationEntity::class);
    }

    public function findAllLimit($limit)
    {
        return $this->findBy(array(), array('id' => 'DESC'), $limit, null);
    }
}