<?php

namespace Tests\Unit\DTO\Blog;

use App\DTO\Blog\BlogItemDTO;
use PHPUnit\Framework\TestCase;

class BlogItemDTOTest extends TestCase
{
    /**
     * @dataProvider itemDataProvider
     *
     * @param int $user_id
     * @param string $title
     * @param string $content
     * @param string $category
     * @param string|null $image_url
     * @param string $meta_keywords
     * @param string $meta_description
     * @param bool $status
     * @param int|null $sort
     * @param string|null $url_slug
     * @return void
     */
    public function testItem(
        int $user_id,
        string $title,
        string $content,
        string $category,
        ?string $image_url,
        string $meta_keywords,
        string $meta_description,
        bool $status,
        ?int $sort,
        ?string $url_slug,
    ): void {
        $blogItemDTO = new BlogItemDTO(
            $user_id,
            $title,
            $content,
            $category,
            $image_url,
            $meta_keywords,
            $meta_description,
            $status,
            $sort,
            $url_slug,
        );

        $this->assertEquals($user_id, $blogItemDTO->getUserId());
        $this->assertEquals($title, $blogItemDTO->getTitle());
        $this->assertEquals($content, $blogItemDTO->getContent());
        $this->assertEquals($category, $blogItemDTO->getCategory());
        $this->assertEquals($image_url, $blogItemDTO->getImageUrl());
        $this->assertEquals($meta_keywords, $blogItemDTO->getMetaKeywords());
        $this->assertEquals($meta_description, $blogItemDTO->getMetaDescription());
        $this->assertEquals($status, $blogItemDTO->isStatus());
        $this->assertEquals($sort, $blogItemDTO->getSort());
        $this->assertEquals($url_slug, $blogItemDTO->getUrlSlug());
    }

    public function itemDataProvider(): array
    {
        return [
            [
                1,
                'first title',
                'first content',
                'first category',
                'first image_url',
                'first meta_keywords',
                'first meta_description',
                true,
                1,
                'first url_slug'
            ],
            [
                1,
                'second title',
                'second content',
                'second category',
                null,
                'second meta_keywords',
                'second meta_description',
                true,
                null,
                null
            ],
            [
                1,
                'new title',
                'new content',
                'new category',
                null,
                'new meta_keywords',
                'new meta_description',
                false,
                null,
                'new url_slug'
            ]
        ];
    }
}
