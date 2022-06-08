<?php

namespace App\Http\Requests\Service;

interface ServiceAllInterface
{
    public function getCategoryId(): ?int;
    public function getStatus(): ?bool;
}