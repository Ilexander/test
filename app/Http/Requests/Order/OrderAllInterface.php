<?php

namespace App\Http\Requests\Order;

interface OrderAllInterface
{
    public function getStartDate(): ?string;
    public function getEndDate(): ?string;
    public function getSortField(): ?string;
    public function getSortType(): ?string;
    public function getLimit(): ?int;
    public function getUserId(): ?int;
    public function getId(): ?array;
    public function getStatus(): ?string;
    public function getSearchField(): ?string;
    public function getSearch(): ?string;
    public function isIsDripFeed(): bool;
    public function setIsDripFeed(bool $is_drip_feed): void;
}
