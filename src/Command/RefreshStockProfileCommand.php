<?php

namespace App\Command;

use App\Entity\Stock;
use App\Service\YahooFinanceApiClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:refresh-stock-profile',
    description: 'Add a short description for your command',
)]
class RefreshStockProfileCommand extends Command
{

    private EntityManagerInterface $entityManager;
    private YahooFinanceApiClient $yahooFinanceApiClient;

    public function __construct(EntityManagerInterface $entityManager, YahooFinanceApiClient $yahooFinanceApiClient)
    {
        $this->entityManager = $entityManager;
        $this->yahooFinanceApiClient = $yahooFinanceApiClient;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('symbol', InputArgument::REQUIRED, 'Stock profile symbol')
            ->addArgument('region', InputArgument::REQUIRED, 'Stock profile region')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // 1. Ping Yahoo API and grab the response
        $stockRecord = $this->yahooFinanceApiClient->fetchStockProfile($input->getArgument('region'), $input->getArgument('symbol'));
        // 2a. Find the stock profile and update
        $stock = $this->entityManager->getRepository(Stock::class)->findOneBy(['symbol' => $stockRecord->symbol, 'region' => $stockRecord->region]);
        if($stock){

        }  else {
        // 2b. Create the stock profile if it doesn't exist
            $stock = new Stock();
            $stock->setRegion($stockRecord->region);
            $stock->setSymbol($stockRecord->symbol);
            $stock->setCurrency($stockRecord->currency);
            $stock->setExchangeName($stockRecord->exchangeName);
            $stock->setPreviousClose($stockRecord->previousClose);
            $stock->setPrice($stockRecord->price);
            $stock->setPriceChange($stockRecord->priceChange);
            $stock->setShortName($stockRecord->shortName);
            $this->entityManager->persist($stock);
        }

        $this->entityManager->persist($stock);
        $this->entityManager->flush();

        $io = new SymfonyStyle($input, $output);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
