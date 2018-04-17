<?php

namespace App\Repository;

use App\Entity\ProduitEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class ProduitEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProduitEntity::class);
    }

    public function findAllWithCriteria($category, $maxPrice, $research)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.type = :category')
            ->andWhere('p.prix <= :maxPrice')
            ->andWhere('p.nom = :category OR p.description = :research')
            ->setParameters([
                'category' => $category,
                'maxPrice' => $maxPrice,
                'research' => $research
            ])
            ->orderBy('p.prix', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
