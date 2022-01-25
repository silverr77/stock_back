<?php

namespace App\Repository;

use App\Entity\CommandeClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeClients[]    findAll()
 * @method CommandeClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeClientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeClients::class);
    }

    // /**
    //  * @return CommandeClients[] Returns an array of CommandeClients objects
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
    public function findOneBySomeField($value): ?CommandeClients
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
