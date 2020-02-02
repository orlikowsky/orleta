<?php

namespace App\Service;

use App\Entity\Match;
use App\Entity\MatchType;
use App\Entity\Table;
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
     * @param array $matchTypes
     * @param User $user
     */
    public function setTypes(array $matchTypes, User $user): void {

        // @todo popraw ten zapis
        foreach ($matchTypes as $match) {
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
                ->setGoalsAway($match->getGoalsAway())
                ->setWinner($this->setWinner($match));

            if($savedMatchType === null) {
                $this->entityManager->persist($matchType);
            }
            $this->entityManager->flush();
        }
    }

    function setWinner(MatchType $match): ?Table {

        if($match->getGoalsHome() > $match->getGoalsAway()) {
            return $match->getMatchGame()->getHome();
        } elseif ($match->getGoalsHome() < $match->getGoalsAway()) {
            return $match->getMatchGame()->getAway();
        }

        return null;
    }

    /**
     * @param MatchRepository $matchRepository
     * @param User $user
     * @return Match
     */
    public function getAllMatches(MatchRepository $matchRepository, User $user): Match {
        return $this->setMatchesInForm($matchRepository->findAll(), $user);
    }

    /**
     * @param int $queue
     * @param MatchRepository $matchRepository
     * @param User $user
     * @return Match
     */
    public function getMatchesFromQueue(int $queue, MatchRepository $matchRepository, User $user): Match {
         $matches = $matchRepository->findMatchesByQueue($queue);

         return $this->setMatchesInForm($matches, $user);
    }

    /**
     * @param array $savedMatches
     * @param User $user
     * @return Match
     */
    private function setMatchesInForm(array $savedMatches, User $user): Match
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