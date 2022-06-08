<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Subscribe\SubscribeAllInterface;
use App\Http\Requests\Subscribe\SubscribeCreateInterface;
use App\Http\Requests\Subscribe\SubscribeDeleteInterface;
use App\Http\Requests\Subscribe\SubscribeInfoInterface;
use App\Http\Requests\Subscribe\SubscribeUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SubscribeInterface
{
    /**
     * @param SubscribeAllInterface $all
     * @return Collection
     */
    public function all(SubscribeAllInterface $all): Collection;

    /**
     * @param SubscribeInfoInterface $info
     * @return Model
     */
    public function info(SubscribeInfoInterface $info): Model;

    /**
     * @param SubscribeCreateInterface $create
     * @return Model
     */
    public function create(SubscribeCreateInterface $create): Model;

    /**
     * @param SubscribeUpdateInterface $update
     * @return bool
     */
    public function update(SubscribeUpdateInterface $update): bool;

    /**
     * @param SubscribeDeleteInterface $delete
     * @return bool
     */
    public function delete(SubscribeDeleteInterface $delete): bool;
}