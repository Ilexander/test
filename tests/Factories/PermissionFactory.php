<?php

declare(strict_types=1);

namespace Tests\Factories;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'name'          => $this->faker->name,
            'guard_name'    => 'web'
        ];
    }

    protected function getModelClassName(): string
    {
        return Permission::class;
    }

    /**
     * @param array $extra
     * @return Model|Permission
     */
    public function create(array $extra = []): Model|Permission
    {
        return parent::create($extra);
    }
}