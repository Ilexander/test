<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransactionFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'payer_email'       => $this->faker->email,
            'payment_id'        => function() {
                return PaymentFactory::new()->create()->id;
            },
            'transaction_id'    => Str::random(32),
            'txn_fee'           => random_int(10, 100000) / 5,
            'amount'            => random_int(10, 100000),
            'status'            => Transaction::STATUS_NEW,
            'system_hash'       => Str::random(32),
            'currency_id'       => function() {
                return CurrencyFactory::new()->create()->id;
            },
            'user_id'           => function() {
                return UserFactory::new()->create()->id;
            },
        ];
    }

    protected function getModelClassName(): string
    {
        return Transaction::class;
    }

    /**
     * @param array $extra
     * @return Model|Transaction
     */
    public function create(array $extra = []): Model|Transaction
    {
        return parent::create($extra);
    }
}