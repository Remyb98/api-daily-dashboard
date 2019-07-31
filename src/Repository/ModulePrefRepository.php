<?php

namespace App\Repository;

use App\Entity\ModulePref;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ModulePref|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModulePref|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModulePref[]    findAll()
 * @method ModulePref[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModulePrefRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ModulePref::class);
    }

    // /**
    //  * @return ModulePref[] Returns an array of ModulePref objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModulePref
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
