<?php

namespace App\Repositories\Payment;

use App\Http\Requests\PaymentBonus\PaymentBonusAllInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusCreateInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusDeleteInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusInfoInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusUpdateInterface;
use App\Interfaces\Repositories\PaymentBonusInterface;
use App\Models\PaymentBonus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentBonusRepository implements PaymentBonusInterface
{
    private PaymentBonus $paymentBonus;

    public function __construct(PaymentBonus $paymentBonus)
    {
        $this->paymentBonus = $paymentBonus;
    }

    public function all(PaymentBonusAllInterface $all): Collection
    {
        return $this
            ->paymentBonus
            ->newQuery()
            ->with('payment')
            ->get();
    }

    public function info(PaymentBonusInfoInterface $info): Model
    {
        return $this
            ->paymentBonus
            ->newQuery()
            ->where('id', $info->getId())
            ->firstOrFail();
    }

    public function create(PaymentBonusCreateInterface $create): Model
    {
        /** @var PaymentBonus $paymentBonus */
        $paymentBonus = new $this->paymentBonus();
        $paymentBonus->fill([
            "payment_id"            => $create->getPaymentId(),
            "bonus_start_funds"     => $create->getBonusStartFunds(),
            "percentage"            => $create->getPercentage(),
            "status"                => $create->getStatus(),
        ]);
        $paymentBonus->save();

        return $paymentBonus;

    }

    public function delete(PaymentBonusDeleteInterface $delete): bool
    {
        return $this
            ->paymentBonus
            ->newQuery()
            ->when($delete->getIds(), function ($query, $ids) {
                return $query->whereIn('id', $ids);
            })
            ->when(!is_null($delete->getStatus()), function ($query, $status) use ($delete) {
                return $query->where('status', $delete->getStatus());
            })
            ->when($delete->getId(), function ($query, $id) {
                return $query->where('id', $id);
            })
            ->delete();
    }

    public function update(PaymentBonusUpdateInterface $update): bool
    {
        return $this
            ->paymentBonus
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                "payment_id"            => $update->getPaymentId(),
                "bonus_start_funds"     => $update->getBonusStartFunds(),
                "percentage"            => $update->getPercentage(),
                "status"                => $update->getStatus(),
            ]);
    }
}
