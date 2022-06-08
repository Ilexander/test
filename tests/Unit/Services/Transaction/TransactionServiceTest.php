<?php

namespace Tests\Unit\Services\Transaction;

use App\Http\Requests\Transaction\TransactionAllInterface;
use App\Http\Requests\Transaction\TransactionCreateInterface;
use App\Http\Requests\Transaction\TransactionDeleteInterface;
use App\Http\Requests\Transaction\TransactionInfoInterface;
use App\Http\Requests\Transaction\TransactionUpdateInterface;
use App\Interfaces\Repositories\TransactionInterface;
use App\Models\Transaction;
use App\Services\Transaction\TransactionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\TransactionFactory;
use Tests\TestCase;

class TransactionServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Transaction $transaction;
    private TransactionService $transactionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->transaction = TransactionFactory::new()->create();

        $collection = new Collection();
        $collection->add($this->transaction);

        $repo = $this->createMock(TransactionInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->transaction);
        $repo->method('add')->willReturn($this->transaction);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $this->transactionService = new TransactionService($repo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDelete()
    {
        $delete = $this->createMock(TransactionDeleteInterface::class);

        $this->assertTrue($this->transactionService->delete($delete));
    }

    public function testUpdate()
    {
        $update = $this->createMock(TransactionUpdateInterface::class);

        $this->assertTrue($this->transactionService->update($update));
    }

    public function testInfo()
    {
        $info = $this->createMock(TransactionInfoInterface::class);

        /** @var Transaction $result */
        $result = $this->transactionService->info($info);

        $this->assertEquals($this->transaction->payer_email, $result->payer_email);
        $this->assertEquals($this->transaction->payment_id, $result->payment_id);
        $this->assertEquals($this->transaction->transaction_id, $result->transaction_id);
        $this->assertEquals($this->transaction->txn_fee, $result->txn_fee);
        $this->assertEquals($this->transaction->amount, $result->amount);
        $this->assertEquals($this->transaction->status, $result->status);
        $this->assertEquals($this->transaction->system_hash, $result->system_hash);
        $this->assertEquals($this->transaction->currency_id, $result->currency_id);
        $this->assertEquals($this->transaction->user_id, $result->user_id);
        $this->assertEquals($this->transaction->id, $result->id);
    }

    public function testAll()
    {
        $all = $this->createMock(TransactionAllInterface::class);

        /** @var Transaction $item */
        foreach ($this->transactionService->all($all) as $item){
            $this->assertEquals($this->transaction->payer_email, $item->payer_email);
            $this->assertEquals($this->transaction->payment_id, $item->payment_id);
            $this->assertEquals($this->transaction->transaction_id, $item->transaction_id);
            $this->assertEquals($this->transaction->txn_fee, $item->txn_fee);
            $this->assertEquals($this->transaction->amount, $item->amount);
            $this->assertEquals($this->transaction->status, $item->status);
            $this->assertEquals($this->transaction->system_hash, $item->system_hash);
            $this->assertEquals($this->transaction->currency_id, $item->currency_id);
            $this->assertEquals($this->transaction->user_id, $item->user_id);
            $this->assertEquals($this->transaction->id, $item->id);
        }
    }

    public function testAdd()
    {
        $create = $this->createMock(TransactionCreateInterface::class);

        /** @var Transaction $result */
        $result = $this->transactionService->add($create);

        $this->assertEquals($this->transaction->payer_email, $result->payer_email);
        $this->assertEquals($this->transaction->payment_id, $result->payment_id);
        $this->assertEquals($this->transaction->transaction_id, $result->transaction_id);
        $this->assertEquals($this->transaction->txn_fee, $result->txn_fee);
        $this->assertEquals($this->transaction->amount, $result->amount);
        $this->assertEquals($this->transaction->status, $result->status);
        $this->assertEquals($this->transaction->system_hash, $result->system_hash);
        $this->assertEquals($this->transaction->currency_id, $result->currency_id);
        $this->assertEquals($this->transaction->user_id, $result->user_id);
        $this->assertEquals($this->transaction->id, $result->id);
    }
}
