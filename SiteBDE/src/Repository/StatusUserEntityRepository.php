<?php

namespace App\Repository;

use App\Entity\StatusUserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatusUserEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusUserEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusUserEntity[]    findAll()
 * @method StatusUserEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusUserEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatusUserEntity::class);
    }

//    /**
//     * @return StatusUserEntity[] Returns an array of StatusUserEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatusUserEntity
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
