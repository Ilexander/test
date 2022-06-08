<?php

namespace App\Repositories\Subscribe;

use App\Http\Requests\Subscribe\SubscribeAllInterface;
use App\Http\Requests\Subscribe\SubscribeCreateInterface;
use App\Http\Requests\Subscribe\SubscribeDeleteInterface;
use App\Http\Requests\Subscribe\SubscribeInfoInterface;
use App\Http\Requests\Subscribe\SubscribeUpdateInterface;
use App\Interfaces\Repositories\SubscribeInterface;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SubscribeRepository implements SubscribeInterface
{
    private Subscribe $subscribe;

    public function __construct(Subscribe $subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * @param SubscribeAllInterface $all
     * @return Collection
     */
    public function all(SubscribeAllInterface $all): Collection
    {

        return $this
            ->subscribe
            ->newQuery()
            ->when($all->getSearch(), function ($query, $search) {
                return $query->where('email', 'like', '%'.$search.'%');
            })
            ->get();
    }

    /**
     * @param SubscribeInfoInterface $info
     * @return Model
     */
    public function info(SubscribeInfoInterface $info): Model
    {
        return $this->subscribe->newQuery()->find($info->getId());
    }

    /**
     * @param SubscribeCreateInterface $create
     * @return Model
     */
    public function create(SubscribeCreateInterface $create): Model
    {
        /** @var Subscribe $subscribe */
        $subscribe = new $this->subscribe();
        $subscribe->fill([
            "first_name"    => $create->getFirstName(),
            "last_name"     => $create->getLastName(),
            "email"         => $create->getEmail(),
            "ip"            => $create->getIp(),
            "country_code"  => $create->getCountryCode(),
        ]);
        $subscribe->save();

        return $subscribe;
    }

    /**
     * @param SubscribeUpdateInterface $update
     * @return bool
     */
    public function update(SubscribeUpdateInterface $update): bool
    {
        return $this
            ->subscribe
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                "first_name"    => $update->getFirstName(),
                "last_name"     => $update->getLastName(),
                "email"         => $update->getEmail(),
                "ip"            => $update->getIp(),
                "country_code"  => $update->getCountryCode(),
            ]);
    }

    /**
     * @param SubscribeDeleteInterface $delete
     * @return bool
     */
    public function delete(SubscribeDeleteInterface $delete): bool
    {
        return $this
            ->subscribe
            ->newQuery()
            ->where('id', $delete->getId())
            ->delete();
    }
}
