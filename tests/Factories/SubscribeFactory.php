<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Model;

class SubscribeFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            "first_name"    => $this->faker->firstName,
            "last_name"     => $this->faker->lastName,
            "email"         => $this->faker->email,
            "ip"            => $this->faker->ipv4,
            "country_code"  => $this->faker->countryCode,
        ];
    }

    protected function getModelClassName(): string
    {
        return Subscribe::class;
    }

    /**
     * @param array $extra
     * @return Model|Subscribe
     */
    public function create(array $extra = []): Model|Subscribe
    {
        return parent::create($extra);
    }
}