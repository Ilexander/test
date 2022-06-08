<?php

namespace App\Services\Language;

use App\Http\Requests\Language\LanguageAllInterface;
use App\Http\Requests\Language\LanguageCreateInterface;
use App\Http\Requests\Language\LanguageDeleteInterface;
use App\Http\Requests\Language\LanguageInfoInterface;
use App\Http\Requests\Language\LanguageUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(LanguageAllInterface $all)
 * @method static info(LanguageInfoInterface $info)
 * @method static create(LanguageCreateInterface $create)
 * @method static update(LanguageUpdateInterface $update)
 * @method static delete(LanguageDeleteInterface $delete)
 */
class LanguageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'languageService';
    }
}