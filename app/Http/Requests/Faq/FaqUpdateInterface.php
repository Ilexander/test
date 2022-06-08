<?php

namespace App\Http\Requests\Faq;

use App\DTO\Translation\TranslationItemDTO;

interface FaqUpdateInterface
{
    public function getId(): int;
    public function getTranslation(string $language): TranslationItemDTO|bool;
    public function getQuestion(): string;
    public function getAnswer(): string;
}
