<?php

namespace App\Services\Faq;

use App\Http\Requests\Faq\FaqAllInterface;
use App\Http\Requests\Faq\FaqCreateInterface;
use App\Http\Requests\Faq\FaqDeleteInterface;
use App\Http\Requests\Faq\FaqInfoInterface;
use App\Http\Requests\Faq\FaqUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(FaqAllInterface $all)
 * @method static info(FaqInfoInterface $info)
 * @method static create(FaqCreateInterface $create)
 * @method static update(FaqUpdateInterface $update)
 * @method static delete(FaqDeleteInterface $delete)
 */
class FaqFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'faqService';
    }
}