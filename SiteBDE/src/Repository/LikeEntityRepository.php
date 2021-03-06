<?php

namespace App\Repository;

use App\Entity\LikeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LikeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeEntity[]    findAll()
 * @method LikeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LikeEntity::class);
    }

//    /**
//     * @return LikeEntity[] Returns an array of LikeEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikeEntity
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getNbLikes($id)
    {
        try {
            return $this->createQueryBuilder('l')
                ->select('COUNT(l)')
                ->where('l.ID_commentaire = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getSingleScalarResult();
        }
        catch(NonUniqueResultException $exception)
        {
            echo $exception;
        }

        return 0;
    }
    */
}
