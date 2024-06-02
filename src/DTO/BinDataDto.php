<?php

namespace App\DTO;

class BinDataDto
{
    protected function __construct(
        public readonly string $countryIso2
        // ...
    ) {
    }

    public static function create(string $countryIso2): BinDataDto
    {
        return new self($countryIso2);
    }
}