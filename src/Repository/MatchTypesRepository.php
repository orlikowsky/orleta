<?php

namespace App\Repository;

use App\Entity\MatchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MatchType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchType[]    findAll()
 * @method MatchType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchTypesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MatchType::class);
    }

    // /**
    //  * @return MatchTypes[] Returns an array of MatchTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MatchTypes
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
