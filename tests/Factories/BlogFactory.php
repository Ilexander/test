<?php

declare(strict_types=1);

namespace Tests\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class BlogFactory extends AbstractTestFactory
{

    protected function defaultFields(): array
    {
        return [
            'user_id'       => function (): int {
                return UserFactory::new()->create()->id;
            },
            "title"             => $this->faker->title,
            "category"          => $this->faker->randomLetter,
            "url_slug"          => $this->faker->url,
            "image_url"         => $this->faker->imageUrl,
            "content"           => $this->faker->randomHtml,
            "meta_keywords"     => $this->faker->title,
            "meta_description"  => $this->faker->title,
            "sort"              => $this->faker->randomNumber(),
            "status"            => true,
        ];
    }

    protected function getModelClassName(): string
    {
        return Blog::class;
    }

    /**
     * @param array $extra
     * @return Model|Blog
     */
    public function create(array $extra = []): Model|Blog
    {
        return parent::create($extra);
    }
}