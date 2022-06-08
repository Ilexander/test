<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\UserPrice;
use Illuminate\Database\Eloquent\Model;

class UserPriceFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'user_id'       => function () {
                return UserFactory::new()->create()->id;
            },
            'service_id'    => function () {
                return ServiceFactory::new()->create()->id;
            },
            'service_price' => random_int(10, 100000) / 5,
        ];
    }

    protected function getModelClassName(): string
    {
        return UserPrice::class;
    }

    /**
     * @param array $extra
     * @return Model|UserPrice
     */
    public function create(array $extra = []): Model|UserPrice
    {
        return parent::create($extra);
    }
}
