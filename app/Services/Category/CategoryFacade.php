<?php

namespace App\Services\Category;

use App\Http\Requests\Category\CategoryAllInterface;
use App\Http\Requests\Category\CategoryCreateInterface;
use App\Http\Requests\Category\CategoryDeleteInterface;
use App\Http\Requests\Category\CategoryInfoInterface;
use App\Http\Requests\Category\CategoryUpdateInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class CategoryFacade
 * @package App\Services\Category
 *
 * @method static list(CategoryAllInterface $all)
 * @method static info(CategoryInfoInterface $info)
 * @method static create(CategoryCreateInterface $create)
 * @method static update(CategoryUpdateInterface $update)
 * @method static delete(CategoryDeleteInterface $delete)
 * @method static fromResponseItem(Category $category)
 * @method static formResponseCollection(Collection $payments)
 */
class CategoryFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'categoryService'; }
}
