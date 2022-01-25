<?php

namespace App\Repository;

use App\Entity\FactureCommandeClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FactureCommandeClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactureCommandeClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactureCommandeClients[]    findAll()
 * @method FactureCommandeClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureCommandeClientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactureCommandeClients::class);
    }

    // /**
    //  * @return FactureCommandeClients[] Returns an array of FactureCommandeClients objects
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
    public function findOneBySomeField($value): ?FactureCommandeClients
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
