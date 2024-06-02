<?php

namespace App\Service\Bin;

use App\Component\Http\HttpClient;
use App\Config\Config;
use App\DTO\BinDataDto;
use HttpException;

class BinListService implements BinProviderServiceInterface
{
    private array $config;

    public function __construct(private HttpClient $httpClient)
    {
        $this->config = Config::getBinProviderConfig(Config::BINLIST_PROVIDER);
    }

    public function getBinData($bin): BinDataDto
    {
        $response = $this->httpClient->get($this->config['url'] . $bin);
//        var_dump($response);
        // TODO: Implement validateResponse() method.

        $response = $this->getResponseContent($response);
//        var_dump('===========================');
//
//        var_dump($response);
//        var_dump('===========================');
//die;
        return BinDataDto::create($response['country']['alpha2']);
    }

    private function getResponseContent($response): array
    {
        // ...

       return  json_decode($response, true);
    }
}