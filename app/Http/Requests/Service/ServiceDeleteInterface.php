<?php

namespace App\Http\Requests\Service;

interface ServiceDeleteInterface
{
    public function getId(): ?int;
    public function getIds(): ?array;
    public function getStatus(): ?bool;
    public function getUserId(): int;
}
