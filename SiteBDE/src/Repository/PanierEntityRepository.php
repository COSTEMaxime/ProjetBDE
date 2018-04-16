<?php

namespace App\Repository;

use App\Entity\PanierEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PanierEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PanierEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PanierEntity[]    findAll()
 * @method PanierEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PanierEntity::class);
    }

//    /**
//     * @return PanierEntity[] Returns an array of PanierEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PanierEntity
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
