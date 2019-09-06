<?php


namespace App\Service;


use App\Entity\Match;
use App\Entity\MatchType;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Promise\TaskQueue;
use Symfony\Component\PropertyInfo\Type;

class MatchTypesService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Match
     */
    private $matches;


//    /**
//     * MatchTypesService constructor.
//     * @param EntityManagerInterface $entityManager
//     */
//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//    }
    /**
     * MatchTypesService constructor.
     * @param EntityManagerInterface $entityManager
     * @param Match $match
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setTypes(array $matches) {

//        foreach ($matches as $match) {
//            $match
//        }

    }
}