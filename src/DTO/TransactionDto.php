<?php

namespace App\DTO;

readonly class TransactionDto
{
    protected function __construct(
        public string $bin,
        public string $amount,
        public string $currency
    ) {
    }

    public static function create(
        string $bin,
        string $amount,
        string $currency
    ) {
      return new self($bin, $amount, $currency);
    }
}