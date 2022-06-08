<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\ApiProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiProviderFactory extends AbstractTestFactory
{
    protected function defaultFields(): array
    {
        return [
            'user_id'       => function (): int {
                return UserFactory::new()->create()->id;
            },
            'name'          => $this->faker->name,
            'url'           => $this->faker->url,
            'key'           => $this->faker->randomNumber(),
            'type'          => $this->faker->name,
            'balance'       => $this->faker->randomNumber(),
            'currency_code' => $this->faker->currencyCode,
            'description'   => $this->faker->name,
            'status'        => true
        ];
    }

    protected function getModelClassName(): string
    {
        return ApiProvider::class;
    }

    /**
     * @param array $extra
     * @return Model|ApiProvider
     */
    public function create(array $extra = []): Model|ApiProvider
    {
        return parent::create($extra);
    }
}