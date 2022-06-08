<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;

class CurrencyFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'name'          => $this->faker->name,
            'description'   => $this->faker->currencyCode,
        ];
    }

    protected function getModelClassName(): string
    {
        return Currency::class;
    }

    /**
     * @param array $extra
     * @return Model|Currency
     */
    public function create(array $extra = []): Model|Currency
    {
        return parent::create($extra);
    }
}