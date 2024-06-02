<?php

namespace App\Tests\Service;

use App\DTO\BinDataDto;
use App\Service\Bin\BinProviderServiceInterface;
use App\Service\RateExchange\RateExchangeServiceInterface;
use App\Service\TransactionCommissionService;
use Exception;
use PHPUnit\Framework\TestCase;

class TransactionCommissionServiceTest extends TestCase
{
    private string                       $filename;
    private BinProviderServiceInterface  $binService;
    private RateExchangeServiceInterface $rateExchangeService;
    private TransactionCommissionService $service;

    protected function setUp(): void
    {
        $this->filename = __DIR__ . '/test_transactions.txt';
        file_put_contents($this->filename, json_encode(
            ['bin' => '45717360', 'amount' => 100.00, 'currency' => 'EUR']
        ));

        $this->binService = $this->createMock(BinProviderServiceInterface::class);
        $this->rateExchangeService = $this->createMock(RateExchangeServiceInterface::class);

        $this->service = new TransactionCommissionService(
            $this->filename,
            $this->binService,
            $this->rateExchangeService,
        );
    }

    protected function tearDown(): void
    {
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    public function testRun(): void
    {
        $this->binService->method('getBinData')->willReturn(BinDataDto::create('DE'));
        $this->rateExchangeService->method('getRate')->willReturn(1.0);

        $result = $this->service->run();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals(1.00, $result[0]);
    }

    public function testGetTransactionCommissionWithInvalidData(): void
    {
        $this->filename = __DIR__ . '/test_transactions.txt';
        file_put_contents($this->filename, json_encode(
            [123,123,123]
        ));

        $this->expectException(Exception::class);
        $this->service->run();
    }
}
