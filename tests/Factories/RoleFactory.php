<?php

declare(strict_types=1);

namespace Tests\Factories;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleFactory extends AbstractTestFactory
{
    protected function defaultFields(): array
    {
        return [
            'name'          => $this->faker->name,
            'guard_name'    => "web",
        ];
    }

    protected function getModelClassName(): string
    {
        return Role::class;
    }

    /**
     * @param array $extra
     * @return Model|Role
     */
    public function create(array $extra = []): Model|Role
    {
        return parent::create($extra);
    }
}