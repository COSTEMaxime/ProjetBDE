<?php

namespace App\Repository;

use App\Entity\CommentLikeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CommentLikeEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentLikeEntity::class);
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
}
