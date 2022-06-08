<?php

namespace App\Services\Api;

use App\Http\Requests\Api\ApiDocParams\ApiDocParamsCreateInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsDeleteInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsListInterface;
use App\Interfaces\Repositories\ApiDocParamsInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiDocParamsService
{
    /**
     * @param ApiDocParamsInterface $repo
     */
    public function __construct(private ApiDocParamsInterface $repo)
    {}

    /**
     * @param ApiDocParamsListInterface $list
     * @return Collection
     */
    public function list(ApiDocParamsListInterface $list): Collection
    {
        return $this->repo->list($list);
    }

    /**
     * @param ApiDocParamsCreateInterface $create
     * @return Model
     */
    public function create(ApiDocParamsCreateInterface $create): Model
    {
        return $this->repo->create($create);
    }

    /**
     * @param ApiDocParamsDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiDocParamsDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }
}