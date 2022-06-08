<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\User\UserAllInterface;
use App\Http\Requests\User\UserCreateInterface;
use App\Http\Requests\User\UserDeleteInterface;
use App\Http\Requests\User\UserInfoInterface;
use App\Http\Requests\User\UserUpdateInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserInterface
{
    public function list(): Collection;

    /**
     * @param UserAllInterface $all
     * @return LengthAwarePaginator
     */
    public function all(UserAllInterface $all): LengthAwarePaginator;

    /**
     * @param UserInfoInterface $info
     * @return Model
     */
    public function info(UserInfoInterface $info): Model;

    /**
     * @param UserCreateInterface $create
     * @return Model
     */
    public function create(UserCreateInterface $create): Model;

    /**
     * @param UserDeleteInterface $delete
     * @return bool
     */
    public function delete(UserDeleteInterface $delete): bool;

    /**
     * @param UserUpdateInterface $update
     * @return bool
     */
    public function update(UserUpdateInterface $update): bool;
}
