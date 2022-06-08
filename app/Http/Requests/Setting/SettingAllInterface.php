<?php

namespace App\Http\Requests\Setting;

interface SettingAllInterface
{
    public function getPageName(): string;
    public function getFieldName(): ?string;
    public function getFieldValue(): ?string;
}
