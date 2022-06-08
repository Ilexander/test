<?php

namespace App\Http\Requests\Category;

interface CategoryInfoInterface
{
    public function getId(): int;
    public function getUserId(): int;
}