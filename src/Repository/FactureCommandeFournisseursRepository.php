<?php

namespace App\Repository;

use App\Entity\FactureCommandeFournisseurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FactureCommandeFournisseurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactureCommandeFournisseurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactureCommandeFournisseurs[]    findAll()
 * @method FactureCommandeFournisseurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureCommandeFournisseursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactureCommandeFournisseurs::class);
    }

    // /**
    //  * @return FactureCommandeFournisseurs[] Returns an array of FactureCommandeFournisseurs objects
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
    public function findOneBySomeField($value): ?FactureCommandeFournisseurs
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
