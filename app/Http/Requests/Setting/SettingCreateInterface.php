<?php

namespace App\Http\Requests\Setting;

interface SettingCreateInterface
{
    public function getPageName(): string;

    public function getFieldName(): string;

    public function getFieldValue(): mixed;

    public function getLanguageName(): ?string;

    public function getLanguageId(): ?int;
}
