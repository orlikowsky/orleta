<?php

namespace App\Service;

use App\Entity\MatchType;
use Doctrine\ORM\EntityManagerInterface;

class MatchTypesService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * MatchTypesService constructor.
     * @param EntityManagerInterface $entityManager
     */

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setTypes(array $matches, $user) {

        foreach ($matches as $match) {
            $matchType = new MatchType();

            $matchType
                ->setUser($user)
                ->setMatchGame($match->getMatchGame())
                ->setGoalsHome($match->getGoalsHome())
                ->setGoalsAway($match->getGoalsAway());

            $this->entityManager->persist($matchType);
        }
        $this->entityManager->flush();
    }
}