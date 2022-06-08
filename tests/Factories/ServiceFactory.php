<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class ServiceFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'user_id'           => function(){
                return UserFactory::new()->create()->id;
            },
            'category_id'       => function(){
                return CategoryFactory::new()->create()->id;
            },
            'name'              => $this->faker->name,
            'desc'              => $this->faker->name,
            'price'             => random_int(10, 100000),
            'original_price'    => random_int(10, 100000),
            'min'               => random_int(10, 100000),
            'max'               => random_int(10, 100000),
            'add_type'          => 'manual',
            'type'              => $this->faker->name,
            'api_service_id'    => random_int(10, 100000),
            'api_provider_id'   => function(){
                return ApiProviderFactory::new()->create()->id;
            },
            'dripfeed'          => true,
            'status'            => true,
        ];
    }

    protected function getModelClassName(): string
    {
        return Service::class;
    }

    /**
     * @param array $extra
     * @return Model|Service
     */
    public function create(array $extra = []): Model|Service
    {
        return parent::create($extra);
    }
}