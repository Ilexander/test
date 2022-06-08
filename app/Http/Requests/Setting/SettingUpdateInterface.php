<?php

namespace App\Http\Requests\Setting;

interface SettingUpdateInterface
{
    public function getId(): int;

    public function getPageName(): string;

    public function getFieldName(): string;

    public function getFieldValue(): string;
}
