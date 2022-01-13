<?php

namespace App\Tests\integration;

use App\Service\YahooFinanceApiClient;
use App\Tests\DatabaseDependentTestCase;

class YahooFinanceApiClientTest extends DatabaseDependentTestCase
{

    public function yahoo_finance_api_client_response_test()
    {
        /** @var YahooFinanceApiClient $yahooFinanceApiClient */
        $yahooFinanceApiClient = self::$kernel->getContainer()->get('yahoo-finance-api-client');

        $response = $yahooFinanceApiClient->fetchStockProfile('US', 'AMZN');

        $stockProfileData = json_decode($response['content']);

        $this->assertSame('AMZN', $stockProfileData->symbol);
        $this->assertSame('US', $stockProfileData->region);
    }

}