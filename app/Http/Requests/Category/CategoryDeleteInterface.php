<?php

namespace App\Http\Requests\Category;

interface CategoryDeleteInterface
{
    public function getId(): ?int;
    public function getIds(): ?array;
    public function getStatus(): ?bool;
    public function getUserId(): int;
}
