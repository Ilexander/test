<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class TicketFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'user_id'       => function() {
                return UserFactory::new()->create()->id;
            },
            'subject'       => $this->faker->name,
            'description'   => $this->faker->name,
            'status'        => Ticket::OPEN_STATUS
        ];
    }

    protected function getModelClassName(): string
    {
        return Ticket::class;
    }

    /**
     * @param array $extra
     * @return Model|Ticket
     */
    public function create(array $extra = []): Model|Ticket
    {
        return parent::create($extra);
    }
}