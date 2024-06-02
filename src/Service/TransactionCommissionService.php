<?php

namespace App\Service;

use App\Component\Utils\Country;
use App\DTO\TransactionDto;
use App\Exception\TransactionCommissionGeneralException;
use App\Service\Bin\BinServiceInterface;
use App\Service\RateExchange\RateExchangeServiceInterface;
use Exception;

readonly class TransactionCommissionService
{

    public function __construct(
        private string                       $filename,
        private BinServiceInterface          $binService,
        private RateExchangeServiceInterface $rateExchangeService
    ) {
    }

    public function run(): array
    {
        try {
            $transactions = $this->readTransactions();

            foreach ($transactions as $transaction) {
                $result[] = $this->getTransactionCommission($transaction);

                print end($result) . PHP_EOL;
            }
        } catch (Exception|TransactionCommissionGeneralException $e) {
            // Log the exception (a proper logging system should be used in real application)
            // Handle the exception gracefully (a proper exception handling should be used in real application)
            throw new Exception($e->getMessage());
        }

        return $result ?? [];
    }

    /**
     * @throws TransactionCommissionGeneralException
     */
    protected function getTransactionCommission(string $transaction): float
    {
        $transaction = $this->parseTransaction($transaction);
        $binData = $this->binService->getBinData($transaction->bin);
        $rate = $this->rateExchangeService->getRate($transaction->currency);
        $isEu = Country::isEu($binData->countryIso2);

        return $this->calculateCommission($transaction, $rate, $isEu);
    }

    protected function readTransactions(): array
    {
        $file = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (!$file) {
            throw new TransactionCommissionGeneralException('Failed to read file');
        }

        return $file;
    }

    protected function calculateCommission(TransactionDto $transaction, float $rate, bool $isEu): float
    {
        $currency = $transaction->currency;
        $amount = $transaction->amount;

        $amountFixed = $currency === 'EUR' || $rate === 0 ? $amount : $amount / $rate;
        $amount = $amountFixed * ($isEu ? 0.01 : 0.02);

        return $this->ceilToCents($amount);
    }

    protected function ceilToCents(float $amount): float
    {
        return ceil($amount * 100) / 100;
    }

    /**
     * @throws TransactionCommissionGeneralException
     */
    protected function parseTransaction($transaction): TransactionDto
    {
        $transactionArray = json_decode($transaction, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($transactionArray)) {
            throw new TransactionCommissionGeneralException('Invalid data provided');
        }

        return TransactionDto::create(
            $transactionArray['bin'],
            $transactionArray['amount'],
            $transactionArray['currency']
        );
    }
}

