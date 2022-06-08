<?php

namespace App\Http\Requests\Language;

use Illuminate\Http\UploadedFile;

interface LanguageCreateInterface
{
    public function getName(): string;
    public function getAlt(): string;
    public function getSupportedCountries(): array;
    public function getStatus(): bool;
    public function getImage(): UploadedFile;
    public function setImageUrl(string $image_url): void;
    public function getImageUrl(): string;
    public function getView(): string;
}
