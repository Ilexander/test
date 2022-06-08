<?php

namespace App\Http\Controllers\Client;

use App\Charts\OrdersChart;
use App\Charts\Ticket\TicketsChart;
use App\Charts\Ticket\WeeklyTicketsChart;
use App\Charts\WeeklyOrdersChart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderAllRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Requests\User\UserAllRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\Order\OrderFacade;
use App\Services\Service\ServiceFacade;
use App\Services\Statistic\StatisticService;
use App\Services\Ticket\TicketFacade;
use App\Services\User\UserFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PanelController extends Controller
{
    public function __construct(private StatisticService $statisticService)
    {}

    public function dashboard(
        Request $request,
        OrdersChart $ordersChart,
        WeeklyOrdersChart $weeklyOrdersChart,
        TicketsChart $ticketsChart,
        WeeklyTicketsChart $weeklyTicketsChart
    ) {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $all = new UserAllRequest();
        $all->merge([
            'sort_field' => 'id',
            'sort_type'  => 'desc',
            'limit'      => 5
        ]);

        $allOrders = new OrderAllRequest();
        $allOrders->merge([
            'sort_field' => 'id',
            'sort_type'  => 'desc',
            'limit'      => 5
        ]);

        $ticketRequest = new TicketAllRequest();
        if ($request->search) {
            $ticketRequest->merge([
                'search' => $request->search
            ]);
        }

        return view('user.dashboard', [
            "user"  => Auth::user(),
            "ticketsList" => TicketFacade::getAllTickets($ticketRequest),
            "blocksData" => $this->statisticService->getDashboardStatistic(),
            "userBlocksData" => $this->statisticService->getUserStatistic(Auth::user()->id),
            "chart" => $ordersChart->build(),
            "weeklyChart" => $weeklyOrdersChart->build(),
            "ticketChart" => $ticketsChart->build(),
            "weeklyTicketChart" => $weeklyTicketsChart->build(),
            "topBestsellers" => ServiceFacade::getTopBestsellers(!Auth::user()->isAdmin() ? Auth::user()->id : null),
            "lastUsers" => UserFacade::all($all),
            "lastOrders" => OrderFacade::all($allOrders),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    public function profile()
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('user.profile', [
            'user' => Auth::user(),
            'user_more_information' => json_decode(Auth::user()->more_information, true),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }
}
