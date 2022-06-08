<?php

namespace App\Repositories\UserPrice;

use App\DTO\User\UserPersonalPriceCollectionDTO;
use App\Http\Requests\UserPrice\UserPriceAllInterface;
use App\Http\Requests\UserPrice\UserPriceCreateInterface;
use App\Http\Requests\UserPrice\UserPriceDeleteInterface;
use App\Http\Requests\UserPrice\UserPriceInfoInterface;
use App\Http\Requests\UserPrice\UserPriceUpdateInterface;
use App\Interfaces\Repositories\UserPriceInterface;
use App\Models\UserPrice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserPriceRepository implements UserPriceInterface
{
    private UserPrice $userPrice;

    public function __construct(UserPrice $userPrice)
    {
        $this->userPrice = $userPrice;
    }

    public function all(UserPriceAllInterface $all): Collection
    {
        return $this
            ->userPrice
            ->newQuery()
            ->with(['user', 'service'])
            ->get();
    }

    public function info(UserPriceInfoInterface $info): Model
    {
        return $this
            ->userPrice
            ->newQuery()
            ->where('id', $info->getId())
            ->firstOrFail();
    }

    public function create(UserPersonalPriceCollectionDTO $create): void
    {
        $insert = [];

        while ($create->current()) {
            $currentItem = $create->getItem($create->getCurrentKey());

            $insert[] = [
                'user_id'       => $currentItem->getUserId(),
                'service_id'    => $currentItem->getServiceId(),
                'service_price' => $currentItem->getServicePrice()
            ];

            $create->next();
        }

        $this->userPrice->newQuery()->insert($insert);

    }

    public function deletePricesByUserId(int $user_id): bool
    {
        return $this
            ->userPrice
            ->newQuery()
            ->where('user_id', $user_id)
            ->delete();
    }

    public function update(UserPriceUpdateInterface $update): bool
    {
        return $this
            ->userPrice
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                'user_id'       => $update->getUserId(),
                'service_id'    => $update->getServiceId(),
                'service_price' => $update->getServicePrice()
            ]);
    }

    public function delete(UserPriceDeleteInterface $delete): bool
    {
        return $this
            ->userPrice
            ->newQuery()
            ->where('id', $delete->getId())
            ->delete();
    }
}