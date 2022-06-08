<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Payment\PaymentAllInterface;
use App\Http\Requests\Payment\PaymentCreateInterface;
use App\Http\Requests\Payment\PaymentDeleteInterface;
use App\Http\Requests\Payment\PaymentInfoInterface;
use App\Http\Requests\Payment\PaymentUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface PaymentInterface
 * @package App\Interfaces\Repositories
 */
interface PaymentInterface
{
    /**
     * @param PaymentAllInterface $all
     * @return Collection
     */
    public function list(PaymentAllInterface $all): Collection;

    /**
     * @param PaymentCreateInterface $create
     * @return Model
     */
    public function add(PaymentCreateInterface $create): Model;

    /**
     * @param PaymentInfoInterface $info
     * @return Model
     */
    public function info(PaymentInfoInterface $info): Model;

    /**
     * @param PaymentDeleteInterface $delete
     * @return bool
     */
    public function delete(PaymentDeleteInterface $delete): bool;

    /**
     * @param PaymentUpdateInterface $update
     * @return bool
     */
    public function update(PaymentUpdateInterface $update): bool;
}