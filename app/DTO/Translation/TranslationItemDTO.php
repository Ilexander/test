<?php

namespace App\DTO\Translation;

class TranslationItemDTO
{
    private string $title;
    private string $context;
    private ?string $item_type;
    private ?int $item_id;
    private ?int $language_id = null;

    public function __construct(
        string $title,
        string $context,
        string $item_type = null,
        int $item_id = null,
    ) {
        $this->title = $title;
        $this->context = $context;
        $this->item_type = $item_type;
        $this->item_id = $item_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    public function getItemType(): ?string
    {
        return $this->item_type;
    }

    public function setItemType(string $item_type): TranslationItemDTO
    {
        $this->item_type = $item_type;

        return $this;
    }

    public function getItemId(): ?int
    {
        return $this->item_id;
    }

    public function setItemId(int $item_id): TranslationItemDTO
    {
        $this->item_id = $item_id;

        return $this;
    }

    public function getLanguageId(): int
    {
        return $this->language_id;
    }

    public function setLanguageId(int $language_id): TranslationItemDTO
    {
        $this->language_id = $language_id;

        return $this;
    }
}