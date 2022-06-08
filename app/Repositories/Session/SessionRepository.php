<?php

namespace App\Repositories\Session;

use App\Http\Requests\Session\SessionAllInterface;
use App\Interfaces\Repositories\SessionInterface;
use App\Models\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SessionRepository implements SessionInterface
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function all(SessionAllInterface $all): Collection
    {
        return $this->session->newQuery()->with(['user'])->get();
    }

    public function create(int $user_id, string $ip): Model
    {
        /** @var Session $session */
        $session = new $this->session();
        $session->fill([
            'user_id'   => $user_id,
            'ip'        => $ip
        ]);
        $session->save();

        return $session;
    }
}