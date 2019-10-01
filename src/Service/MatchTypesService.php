<?php

namespace App\Service;

use App\Entity\MatchType;
use App\Entity\User;
use App\Repository\MatchTypesRepository;
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

    /**
     * @param array $matches
     * @param User $user
     */
    public function setTypes(array $matches, User $user) {

        foreach ($matches as $match) {
            $savedMatchType = $match->getMatchGame()->getMatchTypesByUser($user);
            if($savedMatchType !== null) {
                $matchType = $savedMatchType;
            } else {
                $matchType = new MatchType();
            }

            $matchType
                ->setUser($user)
                ->setMatchGame($match->getMatchGame())
                ->setGoalsHome($match->getGoalsHome())
                ->setGoalsAway($match->getGoalsAway());

            if($savedMatchType === null) {
                $this->entityManager->persist($matchType);
            }
        }
        $this->entityManager->flush();
    }
}