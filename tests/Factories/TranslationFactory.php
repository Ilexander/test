<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TranslationFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'item_type'     => Str::random(32),
            'item_id'       => random_int(1, 9999999),
            'language_id'   => function() {
                return LanguageFactory::new()->create()->id;
            },
            'title'         => $this->faker->title,
            'context'       => Str::random(32),
        ];
    }

    protected function getModelClassName(): string
    {
        return Translation::class;
    }

    /**
     * @param array $extra
     * @return Model|Translation
     */
    public function create(array $extra = []): Model|Translation
    {
        return parent::create($extra);
    }
}