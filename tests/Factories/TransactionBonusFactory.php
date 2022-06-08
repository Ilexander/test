<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\TransactionBonus;
use Illuminate\Database\Eloquent\Model;

class TransactionBonusFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'transaction_id'    => function(){
                return TransactionFactory::new()->create()->id;
            },
            'amount'            => random_int(10, 100000)
        ];
    }

    protected function getModelClassName(): string
    {
        return TransactionBonus::class;
    }

    /**
     * @param array $extra
     * @return Model|TransactionBonus
     */
    public function create(array $extra = []): Model|TransactionBonus
    {
        return parent::create($extra);
    }
}