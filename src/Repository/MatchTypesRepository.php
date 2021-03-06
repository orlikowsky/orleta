<?php

namespace App\Repository;

use App\Entity\MatchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatchType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchType[]    findAll()
 * @method MatchType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchType::class);
    }
}
