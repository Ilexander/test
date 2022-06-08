<?php

namespace App\Services\Subscribe;

use App\Http\Requests\Subscribe\SubscribeAllInterface;
use App\Http\Requests\Subscribe\SubscribeCreateInterface;
use App\Http\Requests\Subscribe\SubscribeDeleteInterface;
use App\Http\Requests\Subscribe\SubscribeInfoInterface;
use App\Http\Requests\Subscribe\SubscribeUpdateInterface;
use App\Interfaces\Repositories\SubscribeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SubscribeService
{
    private SubscribeInterface $repo;

    public function __construct(SubscribeInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param SubscribeAllInterface $all
     * @return Collection
     */
    public function all(SubscribeAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param SubscribeCreateInterface $create
     * @return Model
     */
    public function create(SubscribeCreateInterface $create): Model
    {
        return $this->repo->create($create);
    }

    /**
     * @param SubscribeInfoInterface $info
     * @return Model
     */
    public function info(SubscribeInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param SubscribeUpdateInterface $update
     * @return bool
     */
    public function update(SubscribeUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }

    /**
     * @param SubscribeDeleteInterface $delete
     * @return bool
     */
    public function delete(SubscribeDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }
}