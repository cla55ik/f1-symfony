<?php

namespace App\Repository;

use App\Entity\Racestat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Racestat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Racestat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Racestat[]    findAll()
 * @method Racestat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RacestatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Racestat::class);
    }

    public function getStatsByWinner()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM App\Entity\Racestat r WHERE r.place = 1'
            )
            ->getResult()
        ;
    }

    public function getPilotPoints(int $pilotId): array
    {
        return $this->getEntityManager()
            ->createQuery(
                dql: "SELECT SUM(r.point) FROM App\Entity\Racestat r
                    WHERE r.pilot = :id 
                    "
            )
            ->setParameter('id', $pilotId)
            ->getResult()
            ;
    }

    // /**
    //  * @return Racestat[] Returns an array of Racestat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Racestat
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
