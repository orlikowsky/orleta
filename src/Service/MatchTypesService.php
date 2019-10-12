<?php

namespace App\Service;

use App\Entity\Match;
use App\Entity\MatchType;
use App\Entity\User;
use App\Repository\MatchRepository;
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
    public function setTypes(array $matches, User $user): void {

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

    /**
     * @param MatchRepository $matchRepository
     * @param User $user
     * @return Match
     */
    public function getAllMatches(MatchRepository $matchRepository, User $user): Match {
        return $this->setMatches($matchRepository->findAll(), $user);
    }

    /**
     * @param int $queue
     * @param MatchRepository $matchRepository
     * @param User $user
     * @return Match
     */
    public function getMatchesFromQueue(int $queue, MatchRepository $matchRepository, User $user): Match {
         $matches = $matchRepository->findMatchesByQueue($queue);

         return $this->setMatches($matches, $user);
    }

    /**
     * @param array $savedMatches
     * @param User $user
     * @return Match
     */
    private function setMatches(array $savedMatches, User $user): Match
    {
        $matches = new Match();

        foreach ($savedMatches as $match) {
            $matchTypeSaved = $match->getMatchTypesByUser($user);

            $matchType = new MatchType();
            $matchType->setMatchGame($match);

            if ($matchTypeSaved instanceof MatchType) {
                $matchType->setGoalsHome($matchTypeSaved->getGoalsHome());
                $matchType->setGoalsAway($matchTypeSaved->getGoalsAway());
            }
            $matches->getMatchTypes()->add($matchType);
        }

        return $matches;
    }
}