<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\ApiProvider\ApiProviderAllInterface;
use App\Http\Requests\ApiProvider\ApiProviderCreateInterface;
use App\Http\Requests\ApiProvider\ApiProviderDeleteInterface;
use App\Http\Requests\ApiProvider\ApiProviderInfoInterface;
use App\Http\Requests\ApiProvider\ApiProviderUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ApiProviderInterface
{
    /**
     * @param ApiProviderAllInterface $all
     * @return Collection
     */
    public function list(ApiProviderAllInterface $all): Collection;

    /**
     * @param ApiProviderInfoInterface $info
     * @return Model
     */
    public function info(ApiProviderInfoInterface $info): ?Model;

    /**
     * @param ApiProviderCreateInterface $create
     * @return Model
     */
    public function create(ApiProviderCreateInterface $create): Model;

    /**
     * @param ApiProviderUpdateInterface $update
     * @return bool
     */
    public function update(ApiProviderUpdateInterface $update): bool;

    /**
     * @param ApiProviderDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiProviderDeleteInterface $delete): bool;
}
