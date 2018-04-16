<?php

namespace App\Repository;

use App\Entity\ActiviteEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActiviteEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteEntity[]    findAll()
 * @method ActiviteEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActiviteEntity::class);
    }

//    /**
//     * @return ActiviteEntity[] Returns an array of ActiviteEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActiviteEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
