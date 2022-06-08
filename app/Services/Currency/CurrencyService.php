<?php

namespace App\Services\Currency;

use App\DTO\Currency\CurrencyItemDTO;
use App\DTO\Currency\PaymentCurrencyCollectionDTO;
use App\Http\Requests\Currency\CurrencyAllInterface;
use App\Http\Requests\Currency\CurrencyCreateInterface;
use App\Http\Requests\Currency\CurrencyDeleteInterface;
use App\Http\Requests\Currency\CurrencyInfoInterface;
use App\Http\Requests\Currency\CurrencyUpdateInterface;
use App\Interfaces\Repositories\CurrencyInterface;
use App\Interfaces\Repositories\PaymentCurrencyInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrencyService
 * @package App\Services\Currency
 */
class CurrencyService
{
    private CurrencyInterface $repo;
    private PaymentCurrencyInterface $paymentCurrencyRepo;

    /**
     * CurrencyService constructor.
     * @param CurrencyInterface $repo
     */
    public function __construct(
        CurrencyInterface $repo,
        PaymentCurrencyInterface $paymentCurrencyRepo
    ) {
        $this->repo = $repo;
        $this->paymentCurrencyRepo = $paymentCurrencyRepo;
    }

    /**
     * @param CurrencyCreateInterface $create
     * @return bool
     */
    public function add(CurrencyCreateInterface $create): bool
    {
        return $this->repo->add($create);
    }

    /**
     * @param CurrencyDeleteInterface $delete
     * @return bool
     */
    public function delete(CurrencyDeleteInterface $delete): bool
    {
        return $this->repo->delete(new CurrencyItemDTO($delete->getId()));
    }

    /**
     * @param CurrencyUpdateInterface $update
     * @return bool
     */
    public function update(CurrencyUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }

    /**
     * @param CurrencyInfoInterface $info
     * @return Model
     */
    public function info(CurrencyInfoInterface $info): Model
    {
        return $this->repo->info(new CurrencyItemDTO($info->getId()));
    }

    /**
     * @param CurrencyAllInterface $all
     * @return Collection
     */
    public function all(CurrencyAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->repo->list();
    }

    public function createPaymentCurrency(PaymentCurrencyCollectionDTO $currencyCollectionDTO)
    {
        $this->paymentCurrencyRepo->add($currencyCollectionDTO);
    }

    public function updatePaymentCurrency(int $paymentId, PaymentCurrencyCollectionDTO $currencyCollectionDTO)
    {
        $this->paymentCurrencyRepo->update($paymentId, $currencyCollectionDTO);
    }
}