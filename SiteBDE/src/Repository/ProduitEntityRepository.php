<?php

namespace App\Repository;

use App\Entity\ProduitEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProduitEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitEntity[]    findAll()
 * @method ProduitEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProduitEntity::class);
    }

//    /**
//     * @return ProduitEntity[] Returns an array of ProduitEntity objects
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
    public function findOneBySomeField($value): ?ProduitEntity
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
