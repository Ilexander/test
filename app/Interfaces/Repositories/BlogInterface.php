<?php

namespace App\Interfaces\Repositories;

use App\DTO\Blog\BlogItemDTO;
use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Blog\BlogAllInterface;
use App\Http\Requests\Blog\BlogCreateInterface;
use App\Http\Requests\Blog\BlogDeleteInterface;
use App\Http\Requests\Blog\BlogInfoInterface;
use App\Http\Requests\Blog\BlogUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BlogInterface
{
    /**
     * @param BlogAllInterface $all
     * @return Collection
     */
    public function all(BlogAllInterface $all): Collection;

    /**
     * @param BlogItemDTO $create
     * @return Model
     */
    public function create(BlogItemDTO $create): Model;

    /**
     * @param BlogInfoInterface $info
     * @return Model|null
     */
    public function info(BlogInfoInterface $info): ?Model;

    /**
     * @param BlogItemDTO $update
     * @param int $id
     * @return bool
     */
    public function update(BlogItemDTO $update, int $id): bool;

    /**
     * @param BlogDeleteInterface $delete
     * @return bool
     */
    public function delete(BlogDeleteInterface $delete): bool;
}
