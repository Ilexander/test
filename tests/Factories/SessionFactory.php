<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;

class SessionFactory extends AbstractTestFactory
{
    protected function defaultFields(): array
    {
        return [
            'user_id'   => function(){
                return UserFactory::new()->create()->id;
            },
            'ip'        => $this->faker->ipv4
        ];
    }

    protected function getModelClassName(): string
    {
        return Session::class;
    }

    /**
     * @param array $extra
     * @return Model|Session
     */
    public function create(array $extra = []): Model|Session
    {
        return parent::create($extra);
    }
}