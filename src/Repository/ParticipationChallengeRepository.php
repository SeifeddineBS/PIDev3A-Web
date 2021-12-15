<?php

namespace App\Repository;

use App\Entity\Participationchallenge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participationchallenge|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participationchallenge|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participationchallenge[]    findAll()
 * @method Participationchallenge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationChallengeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participationchallenge::class);
    }

    // /**
    //  * @return Participationchallenge[] Returns an array of Participationchallenge objects
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
    public function findOneBySomeField($value): ?Participationchallenge
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
