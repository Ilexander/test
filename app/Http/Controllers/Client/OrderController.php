<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryAllRequest;
use App\Http\Requests\Order\OrderAllRequest;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderDeleteRequest;
use App\Http\Requests\Order\OrderInfoRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Requests\Service\ServiceAllRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Resources\Service\ServiceListResource;
use App\Models\Order;
use App\Models\Service;
use App\Models\Ticket;
use App\Services\Category\CategoryFacade;
use App\Services\Order\OrderFacade;
use App\Services\Service\ServiceFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @param OrderAllRequest $request
     * @return View
     */
    public function all(OrderAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $request->setIsDripFeed(false);
        $pageConfigs = ['pageHeader' => false];

        return view('user.order', [
            'pageConfigs' => $pageConfigs,
            'orders' => OrderFacade::all($request),
            'categories' => CategoryFacade::list(new CategoryAllRequest()),
            'statuses' => !Auth::user()->isAdmin() ? Order::ORDER_USER_STATUS_LIST : Order::ORDER_STATUS_LIST,
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    public function dripFeed(OrderAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $request->setIsDripFeed(true);
        $pageConfigs = ['pageHeader' => false];

        return view('user.drip-feed', [
            'pageConfigs' => $pageConfigs,
            'orders' => OrderFacade::all($request),
            'categories' => CategoryFacade::list(new CategoryAllRequest()),
            'services' => ServiceFacade::formResponseCollection(ServiceFacade::all(new ServiceAllRequest())),
            'statuses' => Order::ORDER_USER_STATUS_LIST,
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @return View
     */
    public function new(): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('user.order-new', [
            'categories' => CategoryFacade::list(new CategoryAllRequest()),
            'statuses' => Order::ORDER_STATUS_LIST,
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param OrderCreateRequest $request
     * @return RedirectResponse
     */
    public function create(OrderCreateRequest $request): RedirectResponse
    {
        if (Order::ORDER_TYPE_MASS === $request->getOrderType()) {
            $orders = explode(PHP_EOL, $request->getMassOrder());

            /** @var Collection $services */
            $services = Service::query()->get()->keyBy('id');

            foreach ($orders as $order) {
                $orderValues = explode('|', $order);

                $create = new OrderCreateRequest();
                $create->merge([
                    "service_id" => $orderValues[0],
                    "quantity" => $orderValues[1],
                    "link" => $orderValues[2],
                    "category_id" => $services[$orderValues[0]]->category_id
                ]);

                OrderFacade::create($create);
            }
        }

        if (Order::ORDER_TYPE_SINGLE === $request->getOrderType()) {
            OrderFacade::create($request);
        }

        return redirect()->route('user.order.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param OrderUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(OrderUpdateRequest $request): RedirectResponse
    {
        OrderFacade::update($request);

        return redirect()->back();
    }

    /**
     * @param OrderInfoRequest $request
     * @return JsonResponse
     */
    public function info(OrderInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => OrderFacade::info($request)]);
    }

    /**
     * @param OrderDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(OrderDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => OrderFacade::delete($request)]);
    }
}
