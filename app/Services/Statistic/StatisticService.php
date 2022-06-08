<?php

namespace App\Services\Statistic;

use App\Http\Requests\ApiProvider\ApiProviderAllRequest;
use App\Http\Requests\Order\OrderAllRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Requests\Ticket\TicketUserRequest;
use App\Http\Requests\Transaction\TransactionAllRequest;
use App\Http\Requests\User\UserAllRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ApiProvider\ApiProviderFacade;
use App\Services\Order\OrderFacade;
use App\Services\Ticket\TicketFacade;
use App\Services\Transaction\TransactionFacade;
use App\Services\User\UserFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

class StatisticService
{
    public function getDashboardStatistic(): array
    {
        $userAll = new UserAllRequest();
        $userAll->merge([
            "role_id" => User::ROLE_CLIENT
        ]);
        /** @var Collection $clients */
        $clients = UserFacade::all($userAll);

        $transactionAll = new TransactionAllRequest();
        $transactionAll->merge([
            "status_filter" => Transaction::STATUS_SUCCESS
        ]);
        /** @var Collection $transactions */
        $transactions = TransactionFacade::all($transactionAll);

        /** @var Collection $orders */
        $orders = OrderFacade::profitStatistic();

        $ticketsAll = new TicketAllRequest();
        /** @var Collection $tickets */
        $tickets = TicketFacade::getAllTickets($ticketsAll);

        $all = new ApiProviderAllRequest();
        /** @var Collection $apiProviders */
        $apiProviders = ApiProviderFacade::list($all);

        return [
            'clients'   => $clients->count(),
            'total_amount_recieved' => $transactions->pluck('amount', 'id')->sum(),
            'orders'    => $orders->orders,
            'tickets'   => $tickets->count(),
            'total_users_balance' => $clients->pluck('balance', 'id')->sum(),
            'total_providers_balance' => $apiProviders->pluck('balance', 'id')->sum(),
            'monthly_profit'   => $orders->monthly_profit,
            'today_profit'   => $orders->today_profit,
            'orders_statistics' => OrderFacade::statusesStatistic(!Auth::user()->isAdmin() ? Auth::user()->id : null),
            'tickets_statistics' => TicketFacade::statusesStatistic(!Auth::user()->isAdmin() ? Auth::user()->id : null),
        ];
    }

    /**
     * @param int $user_id
     * @return array
     */
    #[ArrayShape([
        'total_orders_count' => "int",
        'active_orders_count' => "int",
        'completed_orders_count' => "int",
        'processing_orders_count' => "int",
        'inprogress_orders_count' => "int",
        'pending_orders_count' => "int",
        'partial_orders_count' => "int",
        'canceled_orders_count' => "int",
        'refunded_orders_count' => "int",
        'total_tickets_count' => "int"
    ])]
    public function getUserStatistic(int $user_id): array
    {
        $all = new OrderAllRequest();
        $all->merge(
            [
                'user_id' => $user_id
            ]
        );
        /** @var Collection $orders */
        $orders = OrderFacade::all($all);

        /** @var Collection $tickets */
        $tickets = TicketFacade::userTicket(new TicketUserRequest());

        return [
            'total_orders_count'    => $orders->count(),
            'active_orders_count'    => $orders->where('status', Order::ORDER_STATUS_ACTIVE)->count(),
            'completed_orders_count'    => $orders->where('status', Order::ORDER_STATUS_COMPLETED)->count(),
            'processing_orders_count'    => $orders->where('status', Order::ORDER_STATUS_PROCESSING)->count(),
            'inprogress_orders_count'    => $orders->where('status', Order::ORDER_STATUS_IN_PROGRESS)->count(),
            'pending_orders_count'    => $orders->where('status', Order::ORDER_STATUS_PENDING)->count(),
            'partial_orders_count'    => $orders->where('status', Order::ORDER_STATUS_PARTIAL)->count(),
            'canceled_orders_count'    => $orders->where('status', Order::ORDER_STATUS_CANCELED)->count(),
            'refunded_orders_count'    => $orders->where('status', Order::ORDER_STATUS_REFUNDED)->count(),
            'total_tickets_count'    => $tickets->count(),
        ];
    }
}
