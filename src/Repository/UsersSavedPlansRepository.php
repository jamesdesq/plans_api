<?php

namespace App\Repository;

use App\Entity\UsersSavedPlans;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersSavedPlans|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersSavedPlans|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersSavedPlans[]    findAll()
 * @method UsersSavedPlans[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersSavedPlansRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersSavedPlans::class);
    }

    // /**
    //  * @return UsersSavedPlans[] Returns an array of UsersSavedPlans objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersSavedPlans
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
