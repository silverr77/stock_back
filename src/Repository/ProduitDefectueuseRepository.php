<?php

namespace App\Repository;

use App\Entity\ProduitDefectueuse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitDefectueuse|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitDefectueuse|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitDefectueuse[]    findAll()
 * @method ProduitDefectueuse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitDefectueuseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitDefectueuse::class);
    }

    // /**
    //  * @return ProduitDefectueuse[] Returns an array of ProduitDefectueuse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitDefectueuse
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
