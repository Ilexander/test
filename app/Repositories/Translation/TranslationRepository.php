<?php

namespace App\Repositories\Translation;

use App\DTO\Translation\TranslationItemDTO;
use App\Interfaces\Repositories\TranslationInterface;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TranslationRepository implements TranslationInterface
{
    private Translation $translation;

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    public function create(TranslationItemDTO $create): Model
    {
        /** @var Translation $translation */
        $translation = new $this->translation();
        $translation->fill([
            'item_type'     => $create->getItemType(),
            'item_id'       => $create->getItemId(),
            'language_id'   => $create->getLanguageId(),
            'title'         => $create->getTitle(),
            'context'       => $create->getContext(),
        ]);
        $translation->save();

        return $translation;
    }

    public function deleteByEntityData(string $entityType, int $entityId): bool
    {
        return $this
            ->translation
            ->newQuery()
            ->where('item_type', $entityType)
            ->where('item_id', $entityId)
            ->delete();
    }

    public function getByEntityData(string $entityType, int $entityId): Collection
    {
        return $this
            ->translation
            ->newQuery()
            ->where('item_type', $entityType)
            ->where('item_id', $entityId)
            ->get();
    }

    public function getByEntityType(string $entityType): Collection
    {
        return $this
            ->translation
            ->newQuery()
            ->where('item_type', $entityType)
            ->get();
    }

    public function deleteByEntityType(string $entityType): bool
    {
        return $this
            ->translation
            ->newQuery()
            ->where('item_type', $entityType)
            ->delete();
    }
}
