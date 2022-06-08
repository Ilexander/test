<?php

namespace App\Services\Blog;

use App\Http\Requests\Blog\BlogAllInterface;
use App\Http\Requests\Blog\BlogCreateInterface;
use App\Http\Requests\Blog\BlogDeleteInterface;
use App\Http\Requests\Blog\BlogInfoInterface;
use App\Http\Requests\Blog\BlogUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(BlogAllInterface $all)
 * @method static info(BlogInfoInterface $info)
 * @method static create(BlogCreateInterface $create)
 * @method static update(BlogUpdateInterface $update)
 * @method static delete(BlogDeleteInterface $delete)
 */
class BlogFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'blogService'; }
}