<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;

class UserFactory extends AbstractTestFactory
{
    protected function defaultFields(): array
    {
        return [
            "email"                 => $this->faker->email,
            "password"              => bcrypt('secret'),
            "role_id"               => function () {
                return RoleFactory::new()->create()->id;
            },
            "login_type"            => 1,
            "first_name"            => $this->faker->firstName,
            "last_name"             => $this->faker->lastName,
            "timezone"              => $this->faker->timezone,
            "more_information"      => "more_information",
            "desc"                  => "desc",
            "balance"               => random_int(10, 100000) / 5,
            "custom_rate"           => 1,
            "api_key"               => $this->faker->randomKey,
            "spent"                 => 0,
            "activation_key"        => $this->faker->randomKey,
            "status"                => User::STATUS_ACTIVE,
        ];
    }

    protected function getModelClassName(): string
    {
        return User::class;
    }
    /**
     * @return Generator
     */
    public function getFaker(): Generator
    {
        return $this->faker;
    }

    /**
     * @param array $extra
     * @return Model|User
     */
    public function create(array $extra = []): Model|User
    {
        return parent::create($extra);
    }
}
