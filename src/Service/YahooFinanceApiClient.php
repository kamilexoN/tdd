<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class YahooFinanceApiClient
{

    public function fetchStockProfile(string $region, string $symbol): JsonResponse
    {

        return $stockProfile;
    }
}