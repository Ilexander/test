<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\PaymentBonus\PaymentBonusAllInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusCreateInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusDeleteInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusInfoInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PaymentBonusInterface
{
    /**
     * @param PaymentBonusAllInterface $all
     * @return Collection
     */
    public function all(PaymentBonusAllInterface $all): Collection;

    /**
     * @param PaymentBonusInfoInterface $info
     * @return Model
     */
    public function info(PaymentBonusInfoInterface $info): Model;

    /**
     * @param PaymentBonusCreateInterface $create
     * @return Model
     */
    public function create(PaymentBonusCreateInterface $create): Model;

    /**
     * @param PaymentBonusDeleteInterface $delete
     * @return bool
     */
    public function delete(PaymentBonusDeleteInterface $delete): bool;

    /**
     * @param PaymentBonusUpdateInterface $update
     * @return bool
     */
    public function update(PaymentBonusUpdateInterface $update): bool;
}