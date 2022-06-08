<?php

namespace App\Services\Translation;

use App\DTO\Translation\TranslationItemDTO;
use App\Interfaces\Repositories\TranslationInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TranslationService
{
    public function __construct(
        private TranslationInterface $repo
    ) {}

    /**
     * @param TranslationItemDTO $create
     * @return Model
     */
    public function create(TranslationItemDTO $create): Model
    {
        return $this->repo->create($create);
    }

    /**
     * @param string $entityType
     * @param int $entityId
     * @return bool
     */
    public function delete(string $entityType, int $entityId): bool
    {
        return $this->repo->deleteByEntityData($entityType, $entityId);
    }

    /**
     * @param string $entityType
     * @param int $entityId
     * @return Collection
     */
    public function getByEntityData(string $entityType, int $entityId): Collection
    {
        return $this->repo->getByEntityData($entityType, $entityId);
    }

    public function getByEntityType(string $entityType): Collection
    {
        return $this->repo->getByEntityType($entityType);
    }

    public function deleteByEntityType(string $entityType): bool
    {
        return $this->repo->deleteByEntityType($entityType);
    }
}
