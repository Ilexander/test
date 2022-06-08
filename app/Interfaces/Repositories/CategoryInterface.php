<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Category\CategoryAllInterface;
use App\Http\Requests\Category\CategoryCreateInterface;
use App\Http\Requests\Category\CategoryDeleteInterface;
use App\Http\Requests\Category\CategoryInfoInterface;
use App\Http\Requests\Category\CategoryUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface CategoryInterface
 * @package App\Interfaces\Repositories
 */
interface CategoryInterface
{
    /**
     * @param CategoryAllInterface $all
     * @return Collection
     */
    public function all(CategoryAllInterface $all): Collection;

    /**
     * @param CategoryInfoInterface $info
     * @return Model
     */
    public function info(CategoryInfoInterface $info): Model;

    /**
     * @param CategoryCreateInterface $create
     * @return Model
     */
    public function add(CategoryCreateInterface $create): Model;

    /**
     * @param CategoryDeleteInterface $delete
     * @return bool
     */
    public function delete(CategoryDeleteInterface $delete): bool;

    /**
     * @param CategoryUpdateInterface $update
     * @return bool
     */
    public function update(CategoryUpdateInterface $update): bool;
}