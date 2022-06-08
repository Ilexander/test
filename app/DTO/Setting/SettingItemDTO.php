<?php
namespace App\DTO\Setting;

class SettingItemDTO
{
    private string $pageName;
    private string $fieldName;
    private mixed $fieldValue;

    public function __construct(string $page_name, string $field_name, mixed $field_value)
    {
        $this->pageName = $page_name;
        $this->fieldName = $field_name;
        $this->fieldValue = $field_value;
    }

    /**
     * @return string
     */
    public function getPageName(): string
    {
        return $this->pageName;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    /**
     * @return mixed
     */
    public function getFieldValue(): mixed
    {
        return $this->fieldValue;
    }
}
