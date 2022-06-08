<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;

class FaqFactory extends AbstractTestFactory
{
    protected function defaultFields(): array
    {
        return [
            "question" => $this->faker->name,
            "answer"   => $this->faker->name
        ];
    }

    protected function getModelClassName(): string
    {
        return Faq::class;
    }

    /**
     * @param array $extra
     * @return Model|Faq
     */
    public function create(array $extra = []): Model|Faq
    {
        return parent::create($extra);
    }
}