<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

class LanguageFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'name'                  => $this->faker->name,
            'alt'                   => $this->faker->languageCode,
            'supported_countries'   => '["Russia", "English"]',
            'status'                => true,
            'image_url'             => $this->faker->imageUrl
        ];
    }

    protected function getModelClassName(): string
    {
        return Language::class;
    }

    /**
     * @param array $extra
     * @return Model|Language
     */
    public function create(array $extra = []): Model|Language
    {
        return parent::create($extra);
    }
}