<?php

namespace App\Service\Bin;

use App\Component\Http\HttpClient;
use App\Config\Config;
use App\DTO\BinDataDto;
use App\Exception\TransactionCommissionGeneralException;

class BinListService implements BinServiceInterface
{
    private array $config;

    public function __construct(private HttpClient $httpClient)
    {
        $this->config = Config::getBinProviderConfig(Config::BINLIST_PROVIDER);
    }

    public function getBinData($bin): BinDataDto
    {
        $response = $this->httpClient->get($this->config['url'] . $bin);

        $this->validateResponse($response);

        $response = $this->getResponseContent($response);

        return BinDataDto::create($response['country']['alpha2']);
    }

    private function getResponseContent($response): array
    {
        $responseContent = json_decode($response, true);

        if (empty($responseContent['country']['alpha2'])) {
            throw new TransactionCommissionGeneralException('Unknown response structure from ' . Config::BINLIST_PROVIDER);
        }

        return $responseContent;
    }

    private function validateResponse($response)
    {
    }
}