<?php

namespace App\Repositories\Transaction;

use App\DTO\Currency\CurrencyItemDTO;
use App\Helpers\ArrayHelper;
use App\Http\Requests\Transaction\TransactionAllInterface;
use App\Http\Requests\Transaction\TransactionCreateInterface;
use App\Http\Requests\Transaction\TransactionDeleteInterface;
use App\Http\Requests\Transaction\TransactionInfoInterface;
use App\Http\Requests\Transaction\TransactionUpdateInterface;
use App\Interfaces\Repositories\TransactionInterface;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Currency\CurrencyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class TransactionRepository
 * @package App\Repositories\Transaction
 */
class TransactionRepository implements TransactionInterface
{
    private Transaction $transaction;
    private CurrencyRepository $currencyRepository;

    /**
     * TransactionRepository constructor.
     * @param Transaction $transaction
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(Transaction $transaction, CurrencyRepository $currencyRepository)
    {
        $this->transaction = $transaction;
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @param TransactionInfoInterface $info
     * @return Model
     */
    public function info(TransactionInfoInterface $info): Model
    {
        return $this
            ->transaction
            ->newQuery()
            ->when(!Auth::user()->isAdmin(), function ($query) use ($info) {
                return $query->where('user_id', $info->getUserId());
            })
            ->where('id', $info->getId())
            ->first();
    }

    /**
     * @param TransactionAllInterface $all
     * @return LengthAwarePaginator
     */
    public function all(TransactionAllInterface $all): LengthAwarePaginator
    {
        return $this
            ->transaction
            ->newQuery()
            ->select('transactions.*')
            ->with(['bonus', 'payment', 'currency'])
            ->when($all->getIdFilter(), function ($query, $id) {
                return $query->where('id', $id);
            })
            ->when($all->getUserId(), function ($query, $user_id) {
                return $query->where('user_id', $user_id);
            })
            ->when((!Auth::user()->isAdmin()), function ($query, $user){
                return $query->where('user_id', Auth::user()->id);
            })
            ->when($all->getStatus(), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($all->getAmountFilter(), function ($query, $amount) {
                return $query->where('amount', $amount);
            })
            ->when($all->getPaymentFilter(), function ($query, $payment) {
                return $query->where('payment_id', $payment);
            })
            ->when($all->getTransactionFeeFilter(), function ($query, $transactionFee) {
                return $query->where('txn_fee', $transactionFee);
            })
            ->when($all->getTransactionIdFilter(), function ($query, $transactionId) {
                return $query->where('transaction_id', $transactionId);
            })
            ->when($all->getUserFilter(), function ($query, $user) {
                return $query
                    ->join(
                        (new User())->getTable().' as u',
                        'transactions.user_id', '=', 'u.id'
                    )
                    ->where('u.email', 'like', '%'.$user.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate($all->getLimit() ?? 10);
    }

    /**
     * @param TransactionUpdateInterface $update
     * @return bool
     */
    public function update(TransactionUpdateInterface $update): bool
    {
        return $this
            ->transaction
            ->newQuery()
            ->where('id', $update->getId())
            ->when(!Auth::user()->isAdmin(), function ($query) use ($update) {
                return $query->where('user_id', $update->getUserId());
            })
            ->update(ArrayHelper::filterEmpty([
                'payer_email'       => $update->getPayerEmail(),
                'payment_id'        => $update->getPaymentId(),
                'transaction_id'    => $update->getTransactionId(),
                'txn_fee'           => $update->getTxnFee(),
                'amount'            => $update->getAmount(),
                'status'            => $update->getStatus(),
                'system_hash'       => $update->getSystemHash(),
                'currency_id'       => $update->getCurrencyId(),
                'user_id'           => $update->getUserId(),
                'note'              => $update->getNote(),
            ]));
    }

    /**
     * @param TransactionDeleteInterface $delete
     * @return bool
     */
    public function delete(TransactionDeleteInterface $delete): bool
    {
        return $this
            ->transaction
            ->newQuery()
            ->where('id', $delete->getId())
            ->where('user_id', $delete->getUserId())
            ->delete();
    }

    public function add(TransactionCreateInterface $create): ?Model
    {
        try {
            if ($create->getUserId() > 0) {
                /** @var Transaction $transaction */
                $transaction = new $this->transaction();
                $transaction->fill([
                    'payer_email'       => Auth::user()->email,
                    'payment_id'        => $create->getPaymentId(),
                    'amount'            => $create->getAmount(),
                    'status'            => Transaction::STATUS_NEW,
                    'system_hash'       => md5(Auth::user()->email.$create->getPaymentId().time().Str::random(32)),
                    'currency_id'       => $create->getCurrency(),
                    'user_id'           => $create->getUserId()
                ]);
                $transaction->save();

                return $transaction;
            }

            return null;
        } catch (\Exception $exception) {
            return null;
        }
    }
}
