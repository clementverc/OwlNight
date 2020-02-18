<?php

namespace App\Repository;

use App\Entity\Associassion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Associassion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Associassion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Associassion[]    findAll()
 * @method Associassion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociassionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Associassion::class);
    }

    // /**
    //  * @return Associassion[] Returns an array of Associassion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Associassion
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
