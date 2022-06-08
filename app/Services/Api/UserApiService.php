<?php

namespace App\Services\Api;

use App\Http\Requests\Order\OrderAllRequest;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Requests\Service\ServiceAllRequest;
use App\Http\Requests\Service\ServiceInfoRequest;
use App\Http\Requests\User\UserAllRequest;
use App\Models\Service;
use App\Services\Order\OrderFacade;
use App\Services\Service\ServiceFacade;
use App\Services\User\UserFacade;
use JetBrains\PhpStorm\ArrayShape;

class UserApiService
{
    #[ArrayShape(["status" => "string", "balance" => "float", "currency" => "string"])]
    public function balance(string $apiKey): array
    {
        $all = new UserAllRequest();
        $all->merge([
            'api_key' => $apiKey
        ]);

        $user = UserFacade::all($all)->first();

        return [
            "status" => "success",
            "balance" => (float)$user->balance,
            "currency" => "USD"
        ];
    }

    #[ArrayShape(
        [
            "service" => "int",
            "name" => "string",
            "category" => "int",
            "rate" => "float",
            "min" => "int",
            "max" => "int",
            "type" => "string",
            "desc" => "string",
            "dripfeed" => "int",
        ]
    )]
    public function services(): array
    {
        $all = new ServiceAllRequest();
        $all->merge([
            'status' => true
        ]);

        $result = [];

        /** @var Service $service */
        foreach (ServiceFacade::all($all) as $service) {
            $result[] = [
                  "service" => $service->id,
                  "name" => $service->name,
                  "category" => $service->category->id,
                  "rate" => $service->price,
                  "min" => $service->min,
                  "max" => $service->max,
                  "type" => $service->type,
                  "desc" => $service->desc,
                  "dripfeed" => $service->dripfeed,
            ];
        }

        return $result;
    }

    public function status(?array $orderIds, string $apiKey): array
    {
        $all = new UserAllRequest();
        $all->merge([
            'api_key' => $apiKey
        ]);

        $user = UserFacade::all($all)->first();

        $all = new OrderAllRequest();
        $all->merge([
            'id' => $orderIds,
            'user_id' => $user->id
        ]);

        $result = [];

        $ordersList = OrderFacade::all($all)->keyBy('id')->toArray();

        foreach ($orderIds as $order) {
            if (isset($ordersList[$order])) {
                $result[$order] = [
                      "order" => $ordersList[$order]["id"],
                      "status" => $ordersList[$order]["status"],
                      "charge" => $ordersList[$order]["charge"],
                      "start_count" => $ordersList[$order]["start_counter"],
                      "remains" => $ordersList[$order]["remains"]
                ];
            } else {
                $result[$order] = "Incorrect order ID";
            }

        }

        return $result;
    }

    public function addOrder(
        int $serviceId,
        string $link,
        int $quantity,
        string $apiKey,
        ?int $runs = null,
        ?int $interval = null
    ) {
        $all = new UserAllRequest();
        $all->merge([
            'api_key' => $apiKey
        ]);

        $user = UserFacade::all($all)->first();

        $info = new ServiceInfoRequest();
        $info->merge([
            "id" => $serviceId
        ]);
        /** @var Service $service */
        $service = ServiceFacade::info($info);

        $create = new OrderCreateRequest();
        $create->merge([
            "category_id"   => $service->category_id,
            "service_id"    => $serviceId,
            "link"          => $link,
            "quantity"      => $quantity
        ]);
        $create->setUserId($user->id);

        $order = OrderFacade::create($create);

        $updateOrder = new OrderUpdateRequest();
        $updateOrder->merge([
            'id'    => $order->id,
            'runs'  => $runs,
            'interval' => $interval,
        ]);
        $updateOrder->setUserId($user->id);

        OrderFacade::update($updateOrder);

        return [
            "status" => "success",
            "order"  => $order->id
        ];
    }
}
