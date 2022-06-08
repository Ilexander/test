<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryFactory extends AbstractTestFactory
{
    protected function defaultFields(): array
    {
        return [
            'user_id'       => function() {
                return UserFactory::new()->create()->id;
            },
            'name'          => $this->faker->name,
            'description'   => Str::random(32),
            'image_url'     => $this->faker->imageUrl,
            'sort'          => random_int(1, 9999999),
            'status'        => true,
        ];
    }

    protected function getModelClassName(): string
    {
        return Category::class;
    }

    /**
     * @param array $extra
     * @return Model|Category
     */
    public function create(array $extra = []): Model|Category
    {
        return parent::create($extra);
    }
}