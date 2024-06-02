<?php

require '../vendor/autoload.php';

use App\Component\Http\HttpClient;
use App\Service\Bin\BinListService;
use App\Service\RateExchange\ExchangeRateService;
use App\Service\TransactionCommissionService;

if ($argc > 1) {
    $binListService = new BinListService(new HttpClient());
    $exchangeRateService = new ExchangeRateService(new HttpClient());

    $processor = new TransactionCommissionService($argv[1], $binListService, $exchangeRateService);
    $result = $processor->run();
} else {
    echo "Usage: php app.php <filename>\n";
}

foreach ($result as $row) {
    echo $row . "\n";
}