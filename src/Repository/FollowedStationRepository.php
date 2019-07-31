<?php

namespace App\Repository;

use App\Entity\FollowedStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FollowedStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method FollowedStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method FollowedStation[]    findAll()
 * @method FollowedStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FollowedStationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FollowedStation::class);
    }

    // /**
    //  * @return FollowedStation[] Returns an array of FollowedStation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FollowedStation
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
