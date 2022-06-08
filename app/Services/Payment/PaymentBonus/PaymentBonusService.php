<?php

namespace App\Services\Payment\PaymentBonus;

use App\Http\Requests\PaymentBonus\PaymentBonusAllInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusCreateInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusDeleteInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusInfoInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusUpdateInterface;
use App\Interfaces\Repositories\PaymentBonusInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentBonusService
{
    private PaymentBonusInterface $repo;

    /**
     * @param PaymentBonusInterface $repo
     */
    public function __construct(PaymentBonusInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param PaymentBonusAllInterface $all
     * @return Collection
     */
    public function all(PaymentBonusAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param PaymentBonusInfoInterface $info
     * @return Model
     */
    public function info(PaymentBonusInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param PaymentBonusCreateInterface $create
     * @return Model
     */
    public function create(PaymentBonusCreateInterface $create): Model
    {
        return $this->repo->create($create);
    }

    /**
     * @param PaymentBonusDeleteInterface $delete
     * @return bool
     */
    public function delete(PaymentBonusDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    /**
     * @param PaymentBonusUpdateInterface $update
     * @return bool
     */
    public function update(PaymentBonusUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }
}