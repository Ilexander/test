<?php

namespace App\Http\Requests\Api\ApiDocs;

interface ApiDocsUpdateInterface
{
    public function getId(): int;
    public function getTitle(): string;
    public function getDescription(): ?string;
    public function getResponse(): ?string;
    public function getRequestParams(): ?array;
}