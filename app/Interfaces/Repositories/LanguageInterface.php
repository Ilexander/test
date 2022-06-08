<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Language\LanguageAllInterface;
use App\Http\Requests\Language\LanguageCreateInterface;
use App\Http\Requests\Language\LanguageDeleteInterface;
use App\Http\Requests\Language\LanguageInfoInterface;
use App\Http\Requests\Language\LanguageUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface LanguageInterface
{
    /**
     * @param LanguageAllInterface $all
     * @return Collection
     */
    public function all(LanguageAllInterface $all): Collection;

    /**
     * @param LanguageCreateInterface $create
     * @return Model
     */
    public function create(LanguageCreateInterface $create): Model;

    /**
     * @param LanguageInfoInterface $info
     * @return Model
     */
    public function info(LanguageInfoInterface $info): Model;

    /**
     * @param LanguageUpdateInterface $update
     * @return bool
     */
    public function update(LanguageUpdateInterface $update): bool;

    /**
     * @param LanguageDeleteInterface $delete
     * @return bool
     */
    public function delete(LanguageDeleteInterface $delete): bool;
}