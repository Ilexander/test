<?php

namespace App\Interfaces\Repositories;

use App\DTO\User\UserPersonalPriceCollectionDTO;
use App\Http\Requests\UserPrice\UserPriceAllInterface;
use App\Http\Requests\UserPrice\UserPriceCreateInterface;
use App\Http\Requests\UserPrice\UserPriceDeleteInterface;
use App\Http\Requests\UserPrice\UserPriceInfoInterface;
use App\Http\Requests\UserPrice\UserPriceUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserPriceInterface
{
    /**
     * @param UserPriceAllInterface $all
     * @return Collection
     */
    public function all(UserPriceAllInterface $all): Collection;

    /**
     * @param UserPriceInfoInterface $info
     * @return Model
     */
    public function info(UserPriceInfoInterface $info): Model;

    /**
     * @param UserPersonalPriceCollectionDTO $create
     * @return void
     */
    public function create(UserPersonalPriceCollectionDTO $create): void;

    /**
     * @param UserPriceUpdateInterface $update
     * @return bool
     */
    public function update(UserPriceUpdateInterface $update): bool;

    /**
     * @param UserPriceDeleteInterface $delete
     * @return bool
     */
    public function delete(UserPriceDeleteInterface $delete): bool;

    /**
     * @param int $user_id
     * @return bool
     */
    public function deletePricesByUserId(int $user_id): bool;
}