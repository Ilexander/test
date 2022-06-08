<?php

namespace App\DTO\User;

use Illuminate\Support\Collection;

class UserCanceledPaymentCollectionDTO
{
    private Collection $collection;
    private int $key = -1;

    public function __construct()
    {
        $this->collection = new Collection();
    }

    public function setItem(UserCanceledPaymentDTO $canceledPaymentDTO): UserCanceledPaymentCollectionDTO
    {
        $this->collection->add($canceledPaymentDTO);
        $this->key = $this->collection->getIterator()->key();

        return $this;
    }

    public function getItem(int $key): UserCanceledPaymentDTO
    {
        return $this->collection->get($key);
    }

    public function getCurrentKey(): int
    {
        return $this->key;
    }

    public function current(): ?UserCanceledPaymentDTO
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