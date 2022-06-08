<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\TicketMessage;
use Illuminate\Database\Eloquent\Model;

class TicketMessageFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'user_id'       => function() {
                return UserFactory::new()->create()->id;
            },
            'ticket_id'     => function() {
                return TicketFactory::new()->create()->id;
            },
            'message'       => $this->faker->name,
            'is_read'       => true
        ];
    }

    protected function getModelClassName(): string
    {
        return TicketMessage::class;
    }

    /**
     * @param array $extra
     * @return Model|TicketMessage
     */
    public function create(array $extra = []): Model|TicketMessage
    {
        return parent::create($extra);
    }
}