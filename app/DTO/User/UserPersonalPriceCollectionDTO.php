<?php

namespace App\DTO\User;

use Illuminate\Support\Collection;

class UserPersonalPriceCollectionDTO
{
    private Collection $collection;
    private int $key = -1;

    public function __construct()
    {
        $this->collection = new Collection();
    }

    public function setItem(UserPersonalPriceDTO $userPersonalPriceDTO): UserPersonalPriceCollectionDTO
    {
        $this->collection->add($userPersonalPriceDTO);
        $this->key = $this->collection->getIterator()->key();

        return $this;
    }

    public function getItem(int $key): UserPersonalPriceDTO
    {
        return $this->collection->get($key);
    }

    public function getCurrentKey(): int
    {
        return $this->key;
    }

    public function current(): ?UserPersonalPriceDTO
    {
        if ($this->collection->has($this->key)) {
            return $this->collection->get($this->key);
        }

        return null;
    }

    public function next(): void
    {
        $this->key++;
    }
}