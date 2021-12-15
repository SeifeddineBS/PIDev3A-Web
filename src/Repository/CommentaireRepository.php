<?php

namespace App\Repository;

use App\Data\SearchData;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;





use phpDocumentor\Reflection\Types\This;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);

    }
    public function Search($data)
    {
        return $this->createQueryBuilder('a')
            ->where('a.commentaire LIKE :data')
            ->setParameter('data', '%'.$data.'%')
            ->getQuery()->getResult()
            ;
    }
}
