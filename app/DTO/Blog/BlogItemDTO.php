<?php

namespace App\DTO\Blog;

class BlogItemDTO
{
    private int $user_id;
    private string $title;
    private string $category;
    private ?string $url_slug;
    private ?string $image_url;
    private string $content;
    private string $meta_keywords;
    private string $meta_description;
    private ?int $sort;
    private bool $status;

    public function __construct(
        int $user_id,
        string $title,
        string $content,
        string $category,
        ?string $image_url,
        string $meta_keywords,
        string $meta_description,
        bool $status,
        ?int $sort = null,
        ?string $url_slug = null,
    ) {
         $this->user_id             = $user_id;
         $this->title               = $title;
         $this->category            = $category;
         $this->url_slug            = $url_slug;
         $this->image_url           = $image_url;
         $this->content             = $content;
         $this->meta_keywords       = $meta_keywords;
         $this->meta_description    = $meta_description;
         $this->sort                = $sort;
         $this->status              = $status;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string|null
     */
    public function getUrlSlug(): ?string
    {
        return $this->url_slug;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getMetaKeywords(): string
    {
        return $this->meta_keywords;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->meta_description;
    }

    /**
     * @return int|null
     */
    public function getSort(): ?int
    {
        return $this->sort;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }
}