<?php

namespace App\Service;

use App\Repository\SeasonRepository;
use App\Repository\UserTableRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\UserTable;
use App\Entity\Season;

class UserTableService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserTableRepository
     */
    private $userTableRepository;

    /**
     * @var SeasonRepository
     */
    private $seasonRepository;

    /**
     * UserTableService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userTableRepository = $this->entityManager->getRepository(UserTable::class);
        $this->seasonRepository = $this->entityManager->getRepository(Season::class);
    }

    public function process(): void
    {
        $users = $this->getUsers();
        $currentSeason = $this->seasonRepository->findOneByCurrent(1);

        foreach ($users as $user) {
            $userTable = $this->userTableRepository->findOneByUser($user);

            if($userTable === null) {
                $userTable = new UserTable();
                $userTable->setUser($user);
                $this->entityManager->persist($userTable);
            }

            $userTable->setSeason($currentSeason);

            $userTable->setPoints($this->setPoints($user));
        }
        $this->entityManager->flush();
    }

    /**
     * @param User $user
     * @return int
     */
    public function setPoints(User $user): int
    {
        $matchTypes = $user->getMatchTypes();

        $points = 0;
        foreach ($matchTypes as $matchType) {
            if($matchType->getWinner() === $matchType->getMatchGame()->getWinner()) {
                if($matchType->getGoalsHome() === $matchType->getMatchGame()->getGoalsHome() &&
                    $matchType->getGoalsAway() === $matchType->getMatchGame()->getGoalsAway()) {
                    $points += 3;
                } else {
                    $points += 1;
                }
            }
        }

        return $points;
    }

    private function getUsers(): array
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        return $userRepository->findAll();
    }
}
