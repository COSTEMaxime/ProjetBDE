<?php

namespace App\Repository;

use App\Entity\PhotoLikeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PhotoLikeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoLikeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoLikeEntity[]    findAll()
 * @method PhotoLikeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoLikeEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PhotoLikeEntity::class);
    }

//    /**
//     * @return PhotoLikeEntity[] Returns an array of PhotoLikeEntity objects
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
    public function findOneBySomeField($value): ?PhotoLikeEntity
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
