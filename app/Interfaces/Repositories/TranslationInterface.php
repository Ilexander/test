<?php

namespace App\Interfaces\Repositories;

use App\DTO\Translation\TranslationItemDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TranslationInterface
{
    /**
     * @param TranslationItemDTO $create
     * @return Model
     */
    public function create(TranslationItemDTO $create): Model;

    /**
     * @param string $entityType
     * @param int $entityId
     * @return bool
     */
    public function deleteByEntityData(string $entityType, int $entityId): bool;

    /**
     * @param string $entityType
     * @param int $entityId
     * @return Collection
     */
    public function getByEntityData(string $entityType, int $entityId): Collection;

    /**
     * @param string $entityType
     * @return Collection
     */
    public function getByEntityType(string $entityType): Collection;

    /**
     * @param string $entityType
     * @return bool
     */
    public function deleteByEntityType(string $entityType): bool;
}
