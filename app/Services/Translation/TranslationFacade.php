<?php

namespace App\Services\Translation;

use App\DTO\Translation\TranslationItemDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static create(TranslationItemDTO $create)
 * @method static delete(string $entityType, int $entityId)
 * @method static getByEntityData(string $entityType, int $entityId)
 * @method static getByEntityType(string $entityType)
 * @method static deleteByEntityType(string $entityType)
 */
class TranslationFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'translationService'; }
}
