<?php

namespace Tests\Unit\Services\Transaction;

use App\DTO\Transaction\TransactionBonusItemDTO;
use App\Interfaces\Repositories\TransactionBonusInterface;
use App\Models\TransactionBonus;
use App\Services\Transaction\TransactionBonusService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\TransactionBonusFactory;
use Tests\Factories\TransactionFactory;
use Tests\TestCase;

class TransactionBonusServiceTest extends TestCase
{
    use DatabaseMigrations;

    private TransactionBonus $transactionBonus;
    private TransactionBonusService $transactionBonusService;

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Exception
     */
    public function testCreate()
    {
        $this->markTestSkipped();
        $transaction = TransactionFactory::new()->create();

        $transactionDTO = $this->createMock(TransactionBonusItemDTO::class);
        $transactionDTO->method('getTransaction')->willReturn($transaction);
        $transactionDTO->method('getAmount')->willReturn(random_int(10, 100000));

        $transactionBonus = TransactionBonusFactory::new()->create();

        $repo = $this->createMock(TransactionBonusInterface::class);
        $repo->method('create')->willReturn($transactionBonus);
        $repo->method('delete')->willReturn(true);
        $repo->method('info')->willReturn($transactionBonus);

        $transactionBonusService = new TransactionBonusService($repo);

        $transactionBonusService->create($transaction);
    }
}
