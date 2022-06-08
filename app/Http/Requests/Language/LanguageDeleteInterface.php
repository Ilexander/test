<?php

namespace App\Http\Requests\Language;

interface LanguageDeleteInterface
{
    public function getId(): ?int;
    public function getUserId(): int;
    public function getIds(): ?array;
    public function getStatus(): ?bool;
}
