<?php

namespace App\Command;

use App\Service\UserTableService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class CreateUserTableCommand extends Command
{
    protected static $defaultName = 'app:create:user:table';

    /**
     * @var UserTableService $userTableService
     */
    private $userTableService;

    /**
     * CreateUserTableCommand constructor.
     * @param UserTableService $userTableService
     */
    public function __construct(UserTableService $userTableService)
    {
        $this->userTableService = $userTableService;
        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Truncates and creates user table.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $this->userTableService->process();

        $io->success('');
    }
}
