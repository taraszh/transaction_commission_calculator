<?php

namespace App\Exception;

use Throwable;

class TransactionCommissionGeneralException extends \Exception
{
    public const int TRANSACTION_COMMISSION_ERROR_CODE = 10;

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, self::TRANSACTION_COMMISSION_ERROR_CODE, $previous);
    }
}