<?php

namespace App\Services\Session;

use App\Http\Requests\Session\SessionAllInterface;
use App\Interfaces\Repositories\SessionInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SessionService
{
    private SessionInterface $repo;

    /**
     * @param SessionInterface $repo
     */
    public function __construct(SessionInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param SessionAllInterface $all
     * @return Collection
     */
    public function all(SessionAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param int $user_id
     * @param string $ip
     * @return Model
     */
    public function create(int $user_id, string $ip): Model
    {
        return $this->repo->create($user_id, $ip);
    }
}