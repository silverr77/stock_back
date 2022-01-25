<?php

namespace App\Repository;

use App\Entity\CommandeFournisseurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeFournisseurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeFournisseurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeFournisseurs[]    findAll()
 * @method CommandeFournisseurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeFournisseursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeFournisseurs::class);
    }

    // /**
    //  * @return CommandeFournisseurs[] Returns an array of CommandeFournisseurs objects
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
    public function findOneBySomeField($value): ?CommandeFournisseurs
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
