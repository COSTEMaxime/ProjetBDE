<?php

namespace App\Repository;

use App\Entity\PhotoEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PhotoEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoEntity[]    findAll()
 * @method PhotoEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PhotoEntity::class);
    }

//    /**
//     * @return PhotoEntity[] Returns an array of PhotoEntity objects
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
    public function findOneBySomeField($value): ?PhotoEntity
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
