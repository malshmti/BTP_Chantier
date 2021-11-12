<?php

namespace App\Repository;

use App\Entity\Materiau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Materiau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiau[]    findAll()
 * @method Materiau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MateriauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiau::class);
    }

    // /**
    //  * @return Materiau[] Returns an array of Materiau objects
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
    public function findOneBySomeField($value): ?Materiau
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
