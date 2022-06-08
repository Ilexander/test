<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'name'                  => $this->faker->name,
            'image_url'             => $this->faker->imageUrl,
            'type'                  => $this->faker->name,
            'min'                   => random_int(10, 100000) / 5,
            'max'                   => random_int(10, 100000) / 5,
            'status'                => true,
            'take_fee_from_user'    => true,
            'client_id'             => Str::random(32),
            'secret_key'            => Str::random(32),
            'limit'                 => random_int(1, 10),
        ];
    }

    protected function getModelClassName(): string
    {
        return Payment::class;
    }

    /**
     * @param array $extra
     * @return Model|Payment
     */
    public function create(array $extra = []): Model|Payment
    {
        return parent::create($extra);
    }
}
