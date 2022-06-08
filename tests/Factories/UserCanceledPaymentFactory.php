<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\UserCanceledPayment;
use Illuminate\Database\Eloquent\Model;

class UserCanceledPaymentFactory extends AbstractTestFactory
{
    protected function defaultFields(): array
    {
        return [
            'user_id'       => function () {
                return UserFactory::new()->create()->id;
            },
            'payment_id'    => function () {
                return PaymentFactory::new()->create()->id;
            }
        ];
    }

    protected function getModelClassName(): string
    {
        return UserCanceledPayment::class;
    }

    /**
     * @param array $extra
     * @return Model|UserCanceledPayment
     */
    public function create(array $extra = []): Model|UserCanceledPayment
    {
        return parent::create($extra);
    }
}
