<?php

namespace App\Services\UserPrice;

use App\DTO\User\UserPersonalPriceCollectionDTO;
use App\DTO\User\UserPersonalPriceDTO;
use App\Http\Requests\UserPrice\UserPriceAllInterface;
use App\Http\Requests\UserPrice\UserPriceCreateInterface;
use App\Http\Requests\UserPrice\UserPriceDeleteInterface;
use App\Http\Requests\UserPrice\UserPriceInfoInterface;
use App\Http\Requests\UserPrice\UserPriceUpdateInterface;
use App\Interfaces\Repositories\UserPriceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserPriceService
{
    private UserPriceInterface $repo;

    /**
     * @param UserPriceInterface $repo
     */
    public function __construct(UserPriceInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param UserPriceAllInterface $all
     * @return Collection
     */
    public function all(UserPriceAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param UserPriceInfoInterface $info
     * @return Model
     */
    public function info(UserPriceInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param UserPersonalPriceCollectionDTO $create
     * @return void
     */
    public function create(UserPersonalPriceCollectionDTO $create): void
    {
        $this->repo->create($create);
    }

    /**
     * @param UserPriceDeleteInterface $delete
     * @return bool
     */
    public function delete(UserPriceDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    /**
     * @param UserPriceUpdateInterface $update
     * @return bool
     */
    public function update(UserPriceUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }

    /**
     * @param int $user_id
     * @return bool
     */
    public function deletePricesByUserId(int $user_id): bool
    {
        return $this->repo->deletePricesByUserId($user_id);
    }
}