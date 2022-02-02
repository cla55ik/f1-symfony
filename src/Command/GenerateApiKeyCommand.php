<?php

namespace App\Command;

use App\Service\Api\ApiAuthService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:generate-api-key',
    description: 'Генерация ApiKey',
)]
class GenerateApiKeyCommand extends Command
{

    protected ApiAuthService $apiAuthService;

    public function __construct(ApiAuthService $apiAuthService)
    {
        $this->apiAuthService = $apiAuthService;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('owner', InputArgument::REQUIRED, 'Owner name:')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $owner = $input->getArgument('owner');

        if (!$owner) {
            $io->note('You need to passed an argument: Owner');
            return Command::INVALID;
        }

        $apiKey = $this->apiAuthService->createNewApiKey($owner);

        $io->success(sprintf('Ok: %s',$apiKey));

        return Command::SUCCESS;
    }
}
