<?php

namespace App\Services\Payment;

use App\DTO\Currency\PaymentCurrencyCollectionDTO;
use App\DTO\Currency\PaymentCurrencyItemDTO;
use App\Http\Requests\Payment\PaymentAllInterface;
use App\Http\Requests\Payment\PaymentCreateInterface;
use App\Http\Requests\Payment\PaymentDeleteInterface;
use App\Http\Requests\Payment\PaymentInfoInterface;
use App\Http\Requests\Payment\PaymentInfoRequest;
use App\Http\Requests\Payment\PaymentUpdateInterface;
use App\Interfaces\Repositories\PaymentInterface;
use App\Models\Payment;
use App\Services\Currency\CurrencyService;
use App\Services\Image\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentService
 * @package App\Services\Payment
 */
class PaymentService
{
    private PaymentInterface $repo;
    private ImageService $imageService;
    private CurrencyService $currencyService;

    /**
     * PaymentService constructor.
     * @param PaymentInterface $repo
     * @param ImageService $imageService
     * @param CurrencyService $currencyService
     */
    public function __construct(
        PaymentInterface $repo,
        ImageService $imageService,
        CurrencyService $currencyService
    ) {
        $this->repo = $repo;
        $this->imageService = $imageService;
        $this->currencyService = $currencyService;
    }

    /**
     * @param PaymentCreateInterface $create
     * @return Model
     */
    public function add(PaymentCreateInterface $create): Model
    {
        if ($create->getImage()) {
            $create->setImageUrl($this->imageService->saveImage($create->getImage()));
        }

        $payment = $this->repo->add($create);

        if ($create->getCurrency()) {
            $this->currencyService->createPaymentCurrency(
                $this->formCurrencyArray($payment->id, $create->getCurrency())
            );
        }

        return $payment;
    }

    /**
     * @param PaymentUpdateInterface $update
     * @return bool
     */
    public function update(PaymentUpdateInterface $update): bool
    {
        if ($update->getImage()) {
            $update->setImageUrl($this->imageService->saveImage($update->getImage()));
        }

        if ($this->repo->update($update) && $update->getCurrency()) {
            $this->currencyService->updatePaymentCurrency(
                $update->getId(),
                $this->formCurrencyArray($update->getId(), $update->getCurrency())
            );
        }

        return false;
    }

    /**
     * @param PaymentDeleteInterface $delete
     * @return bool
     */
    public function delete(PaymentDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    /**
     * @param PaymentInfoInterface $info
     * @return Model
     */
    public function info(PaymentInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param PaymentAllInterface $all
     * @return Collection
     */
    public function list(PaymentAllInterface $all): Collection
    {
        return $this->repo->list($all);
    }

    /**
     * @param int $paymentId
     * @param int $amount
     * @return bool
     */
    public function checkAmountValid(int $paymentId, int $amount): bool
    {
        $info = new PaymentInfoRequest();
        $info->merge([
            'id' => $paymentId
        ]);
        /** @var Payment $payment */
        $payment = $this->info($info);

        return ($payment->min < $amount && $payment->max > $amount);
    }

    public function formResponseCollection(Collection $payments): Collection
    {
        return $payments->map(function ($item, $key) {
            $payment = new Payment();
            $payment->id = $item->id;
            $payment->name = $item->name;
            $payment->image_url = $item->image_url;
            $payment->type = $item->type;
            $payment->min = $item->min;
            $payment->max = $item->max;
            $payment->status = $item->status;
            $payment->take_fee_from_user = $item->take_fee_from_user;
            $payment->limit = $item->limit;
            $payment->created_at = $item->created_at;
            $payment->updated_at = $item->updated_at;
            return $payment;
        });
    }

    private function formCurrencyArray(int $paymentId, array $currencyIds): PaymentCurrencyCollectionDTO
    {
        $collection = new PaymentCurrencyCollectionDTO();

        foreach (array_unique($currencyIds) as $currencyId) {
            $collection->add(new PaymentCurrencyItemDTO($paymentId, $currencyId));
        }

        return $collection;
    }
}
