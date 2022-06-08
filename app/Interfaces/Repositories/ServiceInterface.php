<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Service\ServiceAllInterface;
use App\Http\Requests\Service\ServiceCreateInterface;
use App\Http\Requests\Service\ServiceDeleteInterface;
use App\Http\Requests\Service\ServiceInfoInterface;
use App\Http\Requests\Service\ServiceUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /**
     * @param ServiceAllInterface $all
     * @return Collection
     */
    public function all(ServiceAllInterface $all): Collection;

    /**
     * @param ServiceInfoInterface $info
     * @return Model
     */
    public function info(ServiceInfoInterface $info): Model;

    /**
     * @param ServiceCreateInterface $create
     * @return Model
     */
    public function create(ServiceCreateInterface $create): Model;

    /**
     * @param ServiceUpdateInterface $update
     * @return bool
     */
    public function update(ServiceUpdateInterface $update): bool;

    /**
     * @param ServiceDeleteInterface $delete
     * @return bool
     */
    public function delete(ServiceDeleteInterface $delete): bool;

    public function getTopBestsellers(?int $user_id): array;
}