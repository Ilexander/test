<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Api\ApiDocParams\ApiDocParamsCreateInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsDeleteInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsListInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ApiDocParamsInterface
{
    /**
     * @param ApiDocParamsListInterface $list
     * @return Collection
     */
    public function list(ApiDocParamsListInterface $list): Collection;

    /**
     * @param ApiDocParamsCreateInterface $create
     * @return Model
     */
    public function create(ApiDocParamsCreateInterface $create): Model;

    /**
     * @param ApiDocParamsDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiDocParamsDeleteInterface $delete): bool;
}