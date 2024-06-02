<?php

namespace App\Service\RateExchange;

use App\DTO\BinDataDto;
use App\DTO\TransactionDto;

interface RateExchangeServiceInterface
{
    public function getRate(string $currency): float;
}