<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserTableService extends TableAbstract
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserTableService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function process(): void
    {
        $users = $this->getUsers();

        foreach ($users as $user) {
             $matchTypes = $user->getMatchTypes();
             $this->setPoints($matchTypes);
        }


    }

    private function getUsers(): array
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        return $userRepository->findAll();
    }
}
