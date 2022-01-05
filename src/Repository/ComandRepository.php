<?php

namespace App\Repository;

use App\Entity\Comand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comand[]    findAll()
 * @method Comand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comand::class);
    }

    // /**
    //  * @return comand[] Returns an array of comand objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?comand
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
