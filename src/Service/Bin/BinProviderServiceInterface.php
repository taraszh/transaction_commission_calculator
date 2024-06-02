<?php

namespace App\Service\Bin;

use App\DTO\BinDataDto;

interface BinProviderServiceInterface
{
    public function getBinData($bin): BinDataDto;
}