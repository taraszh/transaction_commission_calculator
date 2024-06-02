<?php

namespace App\Config;

class Config
{
    public const string BINLIST_PROVIDER     = 'bin_list_provider';
    public const string ANOTHER_BIN_PROVIDER = 'another_bin_provider';

    public static function getBinProviderConfig(string $binProvider): array
    {
        $providers = [
            self::BINLIST_PROVIDER => [
                'url'  => 'https://lookup.binlist.net/',
                'auth' => null
            ],
//            ...
//            self::ANOTHER_BIN_PROVIDER => [
//                'url'  => 'https://another-bin-provider.net/api/',
//                'auth' => 'Bearer some-auth-token'
//            ]
        ];

        return $providers[$binProvider];
    }

    public static function getExchangeRateConfig(): array
    {
        return [
            'url'  => 'https://api.exchangeratesapi.io/latest',
            'auth' => null
        ];
    }
}
