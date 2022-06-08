<?php

namespace App\Http\Requests\Blog;

use App\DTO\Translation\TranslationItemDTO;
use Illuminate\Http\UploadedFile;

interface BlogCreateInterface
{
    public function getUserId(): int;
    public function getTranslation(string $language): TranslationItemDTO|bool;
    public function getCategory(): string;
    public function getUrlSlug(): ?string;
    public function getImage(): ?UploadedFile;
    public function getImageUrl(): ?string;
    public function setImageUrl(string $image_url): void;
    public function getMetaKeywords(): string;
    public function getMetaDescription(): string;
    public function getSort(): ?int;
    public function setSort(int $sort): void;
    public function getStatus(): bool;
}