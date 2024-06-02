<?php

namespace App\Service\Bin;

use App\DTO\BinDataDto;

interface BinServiceInterface
{
    public function getBinData($bin): BinDataDto;
}