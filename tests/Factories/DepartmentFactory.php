<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class DepartmentFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'name' => $this->faker->name
        ];
    }

    protected function getModelClassName(): string
    {
        return Department::class;
    }

    /**
     * @param array $extra
     * @return Model|Department
     */
    public function create(array $extra = []): Model|Department
    {
        return parent::create($extra);
    }
}