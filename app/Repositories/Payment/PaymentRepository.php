<?php

namespace App\Repositories\Payment;

use App\Helpers\ArrayHelper;
use App\Http\Requests\Payment\PaymentAllInterface;
use App\Http\Requests\Payment\PaymentCreateInterface;
use App\Http\Requests\Payment\PaymentDeleteInterface;
use App\Http\Requests\Payment\PaymentInfoInterface;
use App\Http\Requests\Payment\PaymentUpdateInterface;
use App\Interfaces\Repositories\PaymentInterface;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class PaymentRepository
 * @package App\Repositories\Payment
 */
class PaymentRepository implements PaymentInterface
{
    private Payment $payment;

    /**
     * PaymentRepository constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @param PaymentAllInterface $all
     * @return Collection
     */
    public function list(PaymentAllInterface $all): Collection
    {
        return $this
            ->payment
            ->newQuery()
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('status', true);
            })
            ->get();
    }

    /**
     * @param PaymentCreateInterface $create
     * @return Model
     */
    public function add(PaymentCreateInterface $create): Model
    {
        /** @var Payment $payment */
        $payment = new $this->payment();
        $payment->fill([
            'name'                  => $create->getName(),
            'image_url'             => $create->getImageUrl(),
            'type'                  => $create->getType(),
            'min'                   => $create->getMin(),
            'max'                   => $create->getMax(),
            'status'                => $create->getStatus(),
            'take_fee_from_user'    => $create->getTakeFeeFromUser(),
            'client_id'             => $create->getClientId(),
            'secret_key'            => $create->getSecretKey(),
            'limit'                 => $create->getLimit(),
        ]);
        $payment->save();

        return $payment;
    }

    /**
     * @param PaymentInfoInterface $info
     * @return Model
     */
    public function info(PaymentInfoInterface $info): Model
    {
        return $this
            ->payment
            ->newQuery()
            ->with(['currencies', 'currencies.currency'])
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('status', true);
            })
            ->find($info->getId());
    }

    /**
     * @param PaymentDeleteInterface $delete
     * @return bool
     */
    public function delete(PaymentDeleteInterface $delete): bool
    {
        return $this
            ->payment
            ->newQuery()
            ->when($delete->getId(), function ($query, $id) {
                return $query->where('id', $id);
            })
            ->when($delete->getIds(), function ($query, $ids) {
                return $query->whereIn('id', $ids);
            })
            ->when(!is_null($delete->getStatus()), function ($query, $status) use ($delete) {
                return $query->where('status', $delete->getStatus());
            })
            ->delete();
    }

    /**
     * @param PaymentUpdateInterface $update
     * @return bool
     */
    public function update(PaymentUpdateInterface $update): bool
    {
        return $this
            ->payment
            ->newQuery()
            ->where('id', $update->getId())
            ->update(ArrayHelper::filterEmpty([
                'name'                  => $update->getName(),
                'image_url'             => $update->getImageUrl(),
                'type'                  => $update->getType(),
                'min'                   => $update->getMin(),
                'max'                   => $update->getMax(),
                'status'                => $update->getStatus(),
                'take_fee_from_user'    => $update->getTakeFeeFromUser(),
                'client_id'             => $update->getClientId(),
                'secret_key'            => $update->getSecretKey(),
                'limit'                 => $update->getLimit(),
            ]));
    }
}
