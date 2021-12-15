<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Activite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activite[]    findAll()
 * @method Activite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activite::class);
    }

    public function rechercher($data)
    {
        return $this->createQueryBuilder('c')
            ->Where('c.id LIKE  :data')->orWhere('c.nombremax LIKE :data')->orWhere('c.lieu LIKE :data')
            ->setParameter('data', '%'.$data.'%')
            ->getQuery()->getResult();
    }
    /**
     * Récupère le prix minimum et maximum correspondant à une recherche
     * @return integer[]
     */
    public function findMinMax(SearchData $search): array
    {
        $results = $this->getSearchQuery($search, true)
            ->select('MIN(p.nombremax) as min', 'MAX(p.nombremax) as max')
            ->getQuery()
            ->getScalarResult();
        return [(int)$results[0]['min'], (int)$results[0]['max']];
    }

    public function findSearch(SearchData $search)
    {
        $query = $this
            ->createQueryBuilder('a')
          ;
        if (!empty($search->lieu)) {
            $query = $query
                ->andWhere('a.lieu LIKE :lieu')
                ->setParameter('lieu', "%{$search->lieu}%");
        }
        if (!empty($search->description)) {
            $query = $query
                ->andWhere('a.description LIKE :description')
                ->setParameter('description', "%{$search->description}%");
        }
        if (!empty($search->nombremax)) {
            $query = $query
                ->andWhere('a.nombremax LIKE :nombremax')
                ->setParameter('nombremax', "%{$search->nombremax}%");
        }
        $query= $query->getQuery()->getResult();

      return  $query;

    }
}
