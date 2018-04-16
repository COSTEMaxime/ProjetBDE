<?php

namespace App\Repository;

use App\Entity\InscritManifestationEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InscritManifestationEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscritManifestationEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscritManifestationEntity[]    findAll()
 * @method InscritManifestationEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscritManifestationEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InscritManifestationEntity::class);
    }

//    /**
//     * @return InscritManifestationEntity[] Returns an array of InscritManifestationEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InscritManifestationEntity
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
