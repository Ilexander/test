<?php

namespace App\Http\Controllers\Client;

use App\DTO\Payment\RequestSuccessDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentAllRequest;
use App\Http\Requests\Payment\PaymentInfoRequest;
use App\Http\Requests\Setting\SettingAllRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Requests\Transaction\TransactionAllRequest;
use App\Http\Requests\Transaction\TransactionCreateRequest;
use App\Http\Requests\Transaction\TransactionDeleteRequest;
use App\Http\Requests\Transaction\TransactionInfoRequest;
use App\Http\Requests\Transaction\TransactionUpdateRequest;
use App\Models\Currency;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Services\Payment\CentAppService;
use App\Services\Payment\CoinPaymentService;
use App\Services\Payment\PayeerService;
use App\Services\Payment\PaymentFacade;
use App\Services\Payment\PerfectMoneyService;
use App\Services\Payment\СustomPaypalService;
use App\Services\Setting\SettingFacade;
use App\Services\Ticket\TicketFacade;
use App\Services\Transaction\TransactionFacade;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Client
 */
class TransactionController extends Controller
{
    private CentAppService $centAppService;
    private CoinPaymentService $coinPaymentService;
    private PayeerService $payeerService;
    private PerfectMoneyService $perfectMoneyService;
    private СustomPaypalService $customPaypalService;

    /**
     * @param CentAppService $centAppService
     * @param CoinPaymentService $coinPaymentService
     * @param PayeerService $payeerService
     * @param PerfectMoneyService $perfectMoneyService
     * @param СustomPaypalService $customPaypalService
     */
    public function __construct(
        CentAppService $centAppService,
        CoinPaymentService $coinPaymentService,
        PayeerService $payeerService,
        PerfectMoneyService $perfectMoneyService,
        СustomPaypalService $customPaypalService
    )
    {
        $this->centAppService = $centAppService;
        $this->coinPaymentService = $coinPaymentService;
        $this->payeerService = $payeerService;
        $this->perfectMoneyService = $perfectMoneyService;
        $this->customPaypalService = $customPaypalService;
    }
    /**
     * @param TransactionAllRequest $request
     * @return View
     */
    public function list(TransactionAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

        return view('user.transaction', [
            'pageConfigs' => $pageConfigs,
            'transactions' => TransactionFacade::all($request),
            'payments' => PaymentFacade::formResponseCollection(PaymentFacade::list(new PaymentAllRequest())),
            'statuses' => Transaction::STATUS_LIST,
            "tickets" => TicketFacade::getAllTickets($allTickets),
            'filters' => [
                "user_filter"               => $request->getUserFilter(),
                "transaction_id_filter"     => $request->getTransactionIdFilter(),
                "payment_filter"            => $request->getPaymentFilter(),
                "amount_filter"             => $request->getAmountFilter(),
                "transaction_fee_filter"    => $request->getTransactionFeeFilter(),
                "status_filter"             => $request->getStatus(),
            ]
        ]);
    }

    /**
     * @param TransactionUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(TransactionUpdateRequest $request): RedirectResponse
    {
        TransactionFacade::update($request);

        return redirect()->route('user.transaction.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param TransactionDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(TransactionDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => TransactionFacade::delete($request)]);
    }

    /**
     * @param TransactionInfoRequest $request
     * @return JsonResponse
     */
    public function info(TransactionInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => TransactionFacade::info($request)]);
    }

    public function create()
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $paypalDayLimitFactor = new SettingAllRequest();
        $paypalDayLimitFactor->merge([
            "page_name"  => Settings::PAYPAL_SETTINGS,
            "field_name" => "paypal_day_limit_factor",
        ]);

        $paypalDayLimitFactor = SettingFacade::list($paypalDayLimitFactor)->first();


        $settingList = new SettingAllRequest();
        $settingList->merge([
            "page_name"  => Settings::PAYPAL_SETTINGS,
            "field_name" => "paypal_minimal_client_amount_sum",
        ]);

        $paymentInfo = Payment::query()
            ->where('type', 'customPaypalService')
            ->first();

        $settings = SettingFacade::list($settingList)->first();

        $transactionsList = new TransactionAllRequest();
        $transactionsList->merge([
            "status_filter" => Transaction::STATUS_SUCCESS
        ]);

        /** @var LengthAwarePaginator $transactions */
        $currentPaypalSum = Transaction::query()
            ->where('status', Transaction::STATUS_SUCCESS)
            ->where('payment_id', ($paymentInfo ? $paymentInfo->id : 0))
            ->whereDate('created_at', date('Y-m-d'))
            ->get()
            ->sum('amount');

        $currentUserAmount = Transaction::query()
            ->where('status', Transaction::STATUS_SUCCESS)
            ->where('payment_id', '!=', ($paymentInfo ? $paymentInfo->id : 0))
            ->get()
            ->sum('amount');

        return view('user.add-funds', [
            'payments' => PaymentFacade::list(new PaymentAllRequest()),
            "tickets" => TicketFacade::getAllTickets($allTickets),
            "minimalClientAmountSum" => $settings ? $settings->field_value : 200,
            "paypalDayLimitFactor" => $paypalDayLimitFactor ? $paypalDayLimitFactor->field_value : 200,
            "currentUserAmount" => $currentUserAmount,
            "currentPaypalSum" => $currentPaypalSum,
            "paypalId" => ($paymentInfo ? $paymentInfo->id : 0)
        ]);
    }

    /**
     * @param TransactionCreateRequest $request
     * @return JsonResponse
     */
    public function add(TransactionCreateRequest $request): JsonResponse
    {
        $info = new PaymentInfoRequest();
        $info->replace(['id' => $request->getPaymentId()]);
        $payment = PaymentFacade::info($info);

        $currency = $request->getCurrency()
            ?? (
                $payment->currencies->isEmpty()
                    ? Currency::query()->where('description', 'USD')->first()->id
                    : $payment->currencies->first()->currency_id
            );

        if ($currency) {
            $request->setCurrency($currency);
        }

        /** @var Transaction $transaction */
        $transaction = TransactionFacade::add($request);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'error' => 'wrong amount'
            ]);
        }

        /** @var RequestSuccessDTO $result */
        $result = $this->{$payment->type}->makeRequest($payment, $transaction);

        $transaction->transaction_id = $result->getTransactionId();
        $transaction->save();

        return response()->json([
            'status' => true,
            'payment' => $result->getPaymentName(),
            'redirect_url' => $result->getRedirectUrl(),
            'provider_data' => $result->getUrlData()
        ]);
    }
}
