<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Article;
use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;





use phpDocumentor\Reflection\Types\This;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);

    }




    public function listOrderByName()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.name','ASC')
            ->getQuery()->getResult();
    }
    public function listOrderByCategories()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.theme','ASC')
            ->getQuery()->getResult();
    }
    public function SearchName($data)
    {
        return $this->createQueryBuilder('a')
            ->where('a.titre LIKE :data')->orWhere('a.theme Like :data ')
            ->setParameter('data', '%'.$data.'%')
            ->getQuery()->getResult()
            ;
    }


}
