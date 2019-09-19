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

    public function getTypeByUser($user) {
        $matchTypes = $this->createQueryBuilder('matchTypes')
            ->where('matchTypes.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getFirstResult();

        return $matchTypes;
    }
}
