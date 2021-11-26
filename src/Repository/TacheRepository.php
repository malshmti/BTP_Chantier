<?php

namespace App\Repository;

use App\Entity\Tache;
use DateTime;
use DateTimeZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tache|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tache|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tache[]    findAll()
 * @method Tache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tache::class);
    }

    public function updateDureeReelle(Tache $tache): void
    {

        $dateDebut = $tache->getDateDebut();
        $dateFin = new DateTime("now", new DateTimeZone('Europe/Paris'));

        if ($dateDebut < $dateFin) {
            echo "Une tâche ne peut pas se terminer avant d'avoir commencé !";
        } else {
            $dureeReelle = date_diff($dateDebut, $dateFin);

            $tache->setDureeReelle($dureeReelle->d);

            $this->_em->persist($tache);
            $this->_em->flush();
        }

    }






    // /**
    //  * @return Tache[] Returns an array of Tache objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tache
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
