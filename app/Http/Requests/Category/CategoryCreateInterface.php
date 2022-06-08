<?php

namespace App\Http\Requests\Category;

use Illuminate\Http\UploadedFile;

interface CategoryCreateInterface
{
    public function getUserId(): int;
    public function getName(): string;
    public function getDescription(): string;
    public function getImage(): ?UploadedFile;
    public function getSort(): int;
    public function getStatus(): bool;
    public function getImageUrl(): ?string;
    public function setImageUrl(string $image_url): void;
}
