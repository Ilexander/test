<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Session\SessionAllInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SessionInterface
{
    /**
     * @param SessionAllInterface $all
     * @return Collection
     */
    public function all(SessionAllInterface $all): Collection;

    /**
     * @param int $user_id
     * @param string $ip
     * @return Model
     */
    public function create(int $user_id, string $ip): Model;
}