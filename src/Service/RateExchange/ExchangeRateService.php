<?php

namespace App\Service\RateExchange;

use App\Component\Http\HttpClient;
use App\Config\Config;
use App\DTO\BinDataDto;
use App\DTO\TransactionDto;
use HttpException;

class ExchangeRateService implements RateExchangeServiceInterface
{
    private array $config;

    public function __construct(private HttpClient $httpClient)
    {
        $this->config = Config::getExchangeRateConfig();
    }

    public function getRate(string $currency): float
    {
        // Couldn't be tested with a request to a third-party API.
        // Authentication required.
        // $response = $this->httpClient->get($this->config['url']);

        // TODO: Implement validateResponse() method.
        // $responseContent = $this->getResponseContent($response);
        // return $responseContent['rates'][$currency];

        return 0.123;
    }

    private function getResponseContent($response): array
    {
        // ...

       return  json_decode($response, true);
    }
}