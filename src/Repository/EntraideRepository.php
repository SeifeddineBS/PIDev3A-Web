<?php

namespace App\Repository;

use App\Entity\Entraide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entraide|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entraide|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entraide[]    findAll()
 * @method Entraide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntraideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entraide::class);
    }

    // /**
    //  * @return Repentraide[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
