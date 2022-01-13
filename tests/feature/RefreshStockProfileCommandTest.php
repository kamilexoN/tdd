<?php

namespace App\Tests\feature;

use App\Entity\Stock;
use App\Tests\DatabaseDependentTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class RefreshStockProfileCommandTest extends DatabaseDependentTestCase
{

    public function refresh_stock_profile_command_behavior_when_record_exist_test(): void
    {
        $application = new Application(self::$kernel);

        $command = $application->find('app:refresh-stock-profile');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'symbol' => 'AMZN',
            'region' => 'US'
        ]);

        $repo = $this->entityManager->getRepository(Stock::class);

        /** @var Stock $stock */
        $stock = $repo->findOneBy(['symbol' => 'AMZN']);

        $this->assertSame('Amazon Inc', $stock->getShortName());
        $this->assertSame('AMZN', $stock->getSymbol());
        $this->assertSame('USD', $stock->getCurrency());
        $this->assertSame('Nasdaq', $stock->getExchangeName());
        $this->assertSame('US', $stock->getRegion());
    }

    public function refresh_stock_profile_command_behavior_when_record_does_not_exist_test(): void
    {
        $application = new Application(self::$kernel);

        $command = $application->find('app:refresh-stock-profile');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'symbol' => 'AMZN',
            'region' => 'US'
        ]);

        $repo = $this->entityManager->getRepository(Stock::class);

        /** @var Stock $stock */
        $stock = $repo->findOneBy(['symbol' => 'AMZN']);

        $this->assertSame('Amazon Inc', $stock->getShortName());
        $this->assertSame('AMZN', $stock->getSymbol());
        $this->assertSame('USD', $stock->getCurrency());
        $this->assertSame('Nasdaq', $stock->getExchangeName());
        $this->assertSame('US', $stock->getRegion());
    }
}