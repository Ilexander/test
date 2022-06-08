<?php

namespace Tests\Unit\DTO\Transaction;

use App\DTO\Transaction\TransactionBonusItemDTO;
use App\Models\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionBonusItemDTOTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @dataProvider itemDataProvider
     *
     * @param Transaction $transaction
     * @param int $amount
     * @return void
     */
    public function testItem(
        Transaction $transaction,
        int $amount
    ): void {
        $transactionBonusItemDTO = new TransactionBonusItemDTO( $transaction, $amount );

        $this->assertEquals($amount, $transactionBonusItemDTO->getAmount());
        $this->assertEquals($transaction->payer_email, $transactionBonusItemDTO->getTransaction()->payer_email);
        $this->assertEquals($transaction->payment_id, $transactionBonusItemDTO->getTransaction()->payment_id);
        $this->assertEquals($transaction->transaction_id, $transactionBonusItemDTO->getTransaction()->transaction_id);
        $this->assertEquals($transaction->txn_fee, $transactionBonusItemDTO->getTransaction()->txn_fee);
        $this->assertEquals($transaction->amount, $transactionBonusItemDTO->getTransaction()->amount);
        $this->assertEquals($transaction->status, $transactionBonusItemDTO->getTransaction()->status);
        $this->assertEquals($transaction->system_hash, $transactionBonusItemDTO->getTransaction()->system_hash);
        $this->assertEquals($transaction->currency_id, $transactionBonusItemDTO->getTransaction()->currency_id);
        $this->assertEquals($transaction->user_id, $transactionBonusItemDTO->getTransaction()->user_id);

    }

    public function itemDataProvider()
    {
        $newTransaction = new Transaction();
        $newTransaction->fill([
            'payer_email'       => 'some email',
            'payment_id'        => 5,
            'transaction_id'    => 'some transaction id',
            'txn_fee'           => true,
            'amount'            => 100,
            'status'            => Transaction::STATUS_NEW,
            'system_hash'       => 'some system hash',
            'currency_id'       => 1,
            'user_id'           => 1
        ]);

        $failedTransaction = new Transaction();
        $failedTransaction->fill([
            'payer_email'       => 'some@gmail.com',
            'payment_id'        => 1,
            'transaction_id'    => 'sfsjncs233nsf',
            'txn_fee'           => false,
            'amount'            => 200,
            'status'            => Transaction::STATUS_FAILED,
            'system_hash'       => 'sbsjnfa23n2sksdk12',
            'currency_id'       => 2,
            'user_id'           => 3
        ]);

        return [
            [
                $newTransaction,
                10
            ],
            [
                $failedTransaction,
                20
            ],
        ];
    }
}
