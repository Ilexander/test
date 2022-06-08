<?php

namespace App\Services\Order;

use App\DTO\Order\OrderItemDTO;
use App\DTO\Service\ServiceItemDTO;
use App\Http\Requests\ApiProvider\ApiProviderAllRequest;
use App\Http\Requests\Order\OrderAllInterface;
use App\Http\Requests\Order\OrderCreateInterface;
use App\Http\Requests\Order\OrderDeleteInterface;
use App\Http\Requests\Order\OrderInfoInterface;
use App\Http\Requests\Order\OrderInfoRequest;
use App\Http\Requests\Order\OrderUpdateInterface;
use App\Http\Requests\Role\RoleInfoRequest;
use App\Http\Requests\Service\ServiceInfoRequest;
use App\Http\Requests\User\UserInfoRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Interfaces\Repositories\OrderInterface;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Services\ApiProvider\ApiProviderFacade;
use App\Services\Service\ServiceFacade;
use App\Services\User\UserFacade;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    private OrderInterface $repo;

    private OrderApiService $apiService;

    /**
     * @param OrderInterface $repo
     * @param OrderApiService $apiService
     */
    public function __construct(OrderInterface $repo, OrderApiService $apiService)
    {
        $this->repo = $repo;
        $this->apiService = $apiService;
    }

    /**
     * @param OrderAllInterface $all
     * @return LengthAwarePaginator
     */
    public function all(OrderAllInterface $all): LengthAwarePaginator
    {
        return $this->repo->all($all);
    }

    /**
     * @param OrderInfoInterface $info
     * @return Model
     */
    public function info(OrderInfoInterface $info):Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param OrderCreateInterface $create
     * @return Model
     */
    public function create(OrderCreateInterface $create): Model
    {
        $serviceInfoRequest = new ServiceInfoRequest();
        $serviceInfoRequest->merge([
            'id' => $create->getServiceId()
        ]);

        /** @var Service $service */
        $service = ServiceFacade::info($serviceInfoRequest);

        $serviceItemDTO = new ServiceItemDTO(
            $service->user_id,
            $service->category_id,
            $service->name,
            $service->desc,
            $service->price,
            $service->original_price,
            $service->min,
            $service->max,
            $service->add_type,
            $service->type,
            $service->api_service_id,
            $service->api_provider_id,
            $service->dripfeed,
            $service->status
        );

        $roleInfo = new RoleInfoRequest();
        $roleInfo->merge([
            'id' => Auth::user()->role_id
        ]);

        $userUpdate = new UserUpdateRequest();
        $userUpdate->merge([
            'id'        => Auth::user()->id,
            'balance'   => (float) (Auth::user()->balance - ($create->getQuantity() * $service->price / 1000))
        ]);

        UserFacade::update($userUpdate, $roleInfo);

        return $this->repo->create($create, $serviceItemDTO);
    }

    /**
     * @param OrderUpdateInterface $update
     * @return bool
     */
    public function update(OrderUpdateInterface $update): bool
    {
        $orderDTO = new OrderItemDTO();
        $orderDTO->setId($update->getId());
        $orderDTO->setUserId($update->getUserId());
        $orderDTO->setRemains($update->getRemains());
        $orderDTO->setStartCounter($update->getStartCounter());
        $orderDTO->setStatus($update->getStatus());
        $orderDTO->setLink($update->getLink());
        $orderDTO->setRuns($update->getRuns());
        $orderDTO->setInterval($update->getInterval());

        $orderInfo = new OrderInfoRequest();
        $orderInfo->merge([
            'id' => $update->getId()
        ]);

        /** @var Order $order */
        $order = $this->info($orderInfo);

        if (
            $order->status !== Order::ORDER_STATUS_CANCELED
            && $update->getStatus() === Order::ORDER_STATUS_CANCELED
        ) {

            $userInfo = new UserInfoRequest();
            $userInfo->merge([
                'id' => $update->getUserId()
            ]);

            /** @var User $user */
            $user = UserFacade::info($userInfo);

            $userUpdate = new UserUpdateRequest();
            $userUpdate->merge([
                'id' => $update->getUserId(),
                'balance' => $user->balance + $order->charge
            ]);

            $roleInfo = new RoleInfoRequest();
            $roleInfo->merge([
                'id' => $user->role_id
            ]);

            UserFacade::update($userUpdate, $roleInfo);
        }

        return $this->repo->update($orderDTO);
    }

    /**
     * @param OrderDeleteInterface $delete
     * @return bool
     */
    public function delete(OrderDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    public function removeOrdersWithWrongLink(): void
    {
        $this->repo->removeOrdersWithoutValidLink();
    }

    public function getOrdersForExecution(): Collection
    {
        return $this->repo->getUnrealizeOrders();
    }

    public function getStartedOrders(): Collection
    {
        return $this->repo->getStartedOrders();
    }

    public function getSubscriptionOrders(): Collection
    {
        return $this->repo->getSubscriptionOrders();
    }

    public function profitStatistic(): object
    {
        return $this->repo->getProfitStatistic();
    }

    public function statusesStatistic(?int $user_id): array
    {
        return $this->repo->statusesStatistic($user_id);
    }

    public function executeOrders(Collection $orders): void
    {
        /** @var Collection $apiProviders */
        $apiProviders = ApiProviderFacade::list(new ApiProviderAllRequest());
        $apiProviders = $apiProviders->keyBy('id')->toArray();

        /** @var Order $order */
        foreach ($orders as $order) {
            if (isset($apiProviders[$order->api_provider_id])) {
                $dataPost = [
                    'key' 	   => $apiProviders[$order->api_provider_id]['key'],
                    'action'   => 'add',
                    'service'  => $order->api_service_id,
                ];

                switch ($order->service_type) {
                    case 'subscriptions':
                        $dataPost["username"] = $order->username;
                        $dataPost["min"]      = $order->sub_min;
                        $dataPost["max"]      = $order->sub_max;
                        $dataPost["posts"]    = ($order->sub_posts == -1) ? 0 : $order->sub_posts ;
                        $dataPost["delay"]    = $order->sub_delay;
                        $dataPost["expiry"]   = (!empty($order->sub_expiry))
                            ? date("d/m/Y",  strtotime($order->sub_expiry))
                            : "";//change date format dd/mm/YYYY
                        break;
                    case 'custom_comments':
                    case 'custom_comments_package':
                        $dataPost["link"]     = $order->link;
                        $dataPost["comments"] = json_decode($order->comments);
                        break;
                    case 'mentions_with_hashtags':
                        $dataPost["link"]         = $order->link;
                        $dataPost["quantity"]     = $order->quantity;
                        $dataPost["usernames"]    = $order->usernames;
                        $dataPost["hashtags"]     = $order->hashtags;
                        break;
                    case 'mentions_custom_list':
                        $dataPost["link"]         = $order->link;
                        $dataPost["usernames"]    = json_decode($order->usernames);
                        break;
                    case 'mentions_hashtag':
                        $dataPost["link"]         = $order->link;
                        $dataPost["quantity"]     = $order->quantity;
                        $dataPost["hashtag"]      = $order->hashtag;
                        break;
                    case 'comment_likes':
                    case 'mentions_user_followers':
                        $dataPost["link"]         = $order->link;
                        $dataPost["quantity"]     = $order->quantity;
                        $dataPost["username"]     = $order->username;
                        break;
                    case 'mentions_media_likers':
                        $dataPost["link"]         = $order->link;
                        $dataPost["quantity"]     = $order->quantity;
                        $dataPost["media"]        = $order->media;
                        break;
                    case 'package':
                        $dataPost["link"]         = $order->link;
                        break;
                    default:
                        $dataPost["link"] = $order->link;
                        $dataPost["quantity"] = $order->quantity;
                        if (isset($order->is_drip_feed) && $order->is_drip_feed == 1) {
                            $dataPost["runs"]     = $order->runs;
                            $dataPost["interval"] = $order->interval;
                            $dataPost["quantity"] = $order->dripfeed_quantity;
                        }else{
                            $dataPost["quantity"] = $order->quantity;
                        }
                        break;
                }

                $response = $this->apiService->connectApi(
                    $apiProviders[$order->api_provider_id]['url'],
                    $dataPost
                );

                $this->checkResponseError($response, $order);

                if (isset($response['order'])) {
                    $orderDTO = new OrderItemDTO();
                    $orderDTO->setId($order->id);
                    $orderDTO->setUserId($order->user_id);
                    $orderDTO->setStatus(Order::ORDER_STATUS_IN_PROGRESS);
                    $orderDTO->setApiOrderId($response['order']);

                    $this->repo->update($orderDTO);
                }
            }
        }
    }

    public function checkOrdersStatus(Collection $orders): void
    {
        /** @var Collection $apiProviders */
        $apiProviders = ApiProviderFacade::list(new ApiProviderAllRequest());
        $apiProviders = $apiProviders->keyBy('id')->toArray();

        /** @var Order $order */
        foreach ($orders as $order) {
            if (isset($apiProviders[$order->api_provider_id])) {
                $dataPost = [
                    'key' 	   => $apiProviders[$order->api_provider_id]['key'],
                    'action'   => 'status',
                    'order'    => $order->api_order_id,
                ];

                $response = $this->apiService->connectApi(
                    $apiProviders[$order->api_provider_id]['url'],
                    $dataPost
                );

                $this->checkResponseError($response, $order);

                if (isset($response['status']) && $response['status'] != "") {

                    if (!in_array(strtolower(str_replace(' ', '', $response['status'])), [
                            Order::ORDER_STATUS_COMPLETED,
                            Order::ORDER_STATUS_PROCESSING,
                            Order::ORDER_STATUS_IN_PROGRESS,
                            Order::ORDER_STATUS_PARTIAL,
                            Order::ORDER_STATUS_CANCELED,
                            Order::ORDER_STATUS_REFUNDED,
                            Order::ORDER_STATUS_COMPLETED,
                        ])
                    ) {
                        $response['status'] = Order::ORDER_STATUS_PENDING;
                    }

                    $orderDTO = new OrderItemDTO();

                    switch ($order->is_drip_feed) {
                        case 1:

                            if (strrpos($response['status'], Order::ORDER_API_STATUS_PROCESS)
                                || strrpos(strtolower($response->status), Order::ORDER_STATUS_ACTIVE)
                            ) {
                                $statusDripFeed = Order::ORDER_STATUS_IN_PROGRESS;
                            }else {
                                $statusDripFeed = str_replace(" ", "", $response['status']);
                                $statusDripFeed = str_replace("_", "", $statusDripFeed);
                                $statusDripFeed = strtolower($statusDripFeed);
                            }

                            if (!in_array($statusDripFeed, [
                                Order::ORDER_STATUS_CANCELED,
                                Order::ORDER_STATUS_IN_PROGRESS,
                                Order::ORDER_STATUS_COMPLETED
                            ])) {
                                $statusDripFeed = Order::ORDER_STATUS_IN_PROGRESS;
                            }

                            $orderDTO->setStatus($statusDripFeed);

                            if (isset($response['runs'])) {
                                $orderDTO->setSubResponseOrders(json_encode($response));
                            } else {
                                switch (strtolower(str_replace(' ', '', $response['status']))) {
                                    case Order::ORDER_STATUS_COMPLETED:
                                        $response['status'] = Order::ORDER_SUB_STATUS_COMPLETED;
                                        $response['runs']   = $order->runs;
                                        break;

                                    case Order::ORDER_STATUS_IN_PROGRESS:
                                        $response['status'] = ucfirst(Order::ORDER_STATUS_IN_PROGRESS);
                                        $response['runs']   = 0;
                                        break;

                                    case 'Canceled':
                                        $response['status'] = Order::ORDER_SUB_STATUS_CANCELED;
                                        $response['runs']   = 0;
                                        break;
                                }
                                $orderDTO->setSubResponseOrders(json_encode($response));
                            }

                            if (isset($response['status'])) {
                                $dbDripFeed = json_decode($order->sub_response_orders);
                                if (isset($dbDripFeed->orders)) {
                                    $newDripFeedOrders = array_diff($response['orders'], $dbDripFeed->orders);
                                }else{
                                    $newDripFeedOrders = $response['orders'];
                                }
                                if (!empty($newDripFeedOrders)) {

                                    $serviceInfoRequest = new ServiceInfoRequest();
                                    $serviceInfoRequest->merge([
                                        'id' => $order->service_id
                                    ]);

                                    /** @var Service $service */
                                    $service = ServiceFacade::info($serviceInfoRequest);

                                    $this->repo->insertOrderFromDripFeedSubscription(
                                        $order,
                                        $apiProviders[$order->api_provider_id],
                                        $newDripFeedOrders,
                                        $service
                                    );
                                }
                            }

                            break;

                        default:
                            $remains = $response['remains'];
                            if ($remains < 0) {
                                $remains = abs($remains);
                                $remains = "+".$remains;
                            }

                            $orderDTO->setStartCounter($response['start_count']);
                            $orderDTO->setRemains($remains);
                            $orderDTO->setNote("");
                            $orderDTO->setStatus(
                                (($response['status'] == "In progress")
                                ? Order::ORDER_STATUS_IN_PROGRESS
                                :  strtolower($response['status']))
                            );

                            break;
                    }

                    if (!collect((array) $orderDTO)->every(fn ($v) =>is_null($v))) {
                        if ($order->sub_response_posts != 1
                            && (
                                $response["status"] == ucfirst(Order::ORDER_STATUS_REFUNDED)
                                || $response["status"] == Order::ORDER_SUB_STATUS_CANCELED
                                || $response["status"] == ucfirst(Order::ORDER_STATUS_PARTIAL)
                            )
                        ) {
                            $orderDTO->setCharge(0);
                            $formalCharge = 0;
                            $profit        = 0;

                            $returnFunds = $charge = $order->charge;
                            if ($response["status"] == ucfirst(Order::ORDER_STATUS_PARTIAL)) {
                                $orderRemains = $response['remains'];
                                if ($order->quantity < $response['remains']) {
                                    $orderRemains = $order->quantity;
                                    $orderDTO->setRemains($orderRemains);
                                }
                                $returnFunds 	=  $charge * ($orderRemains / $order->quantity);
                                $realCharge 	= $charge - $returnFunds;

                                $formalCharge  = $order->formal_charge * (1 - ($orderRemains / $order->quantity ));
                                $profit         = $order->profit * (1 - ($orderRemains / $order->quantity ));

                                $orderDTO->setCharge($realCharge);
                            }

                            $orderDTO->setFormalCharge($formalCharge);
                            $orderDTO->setProfit($profit);

                            /** @var User $user */
                            $user = Auth::user();

                            if (!empty($user)) {
                                $balance = $user->balance;
                                $balance += $returnFunds;
                                $user->balance = $balance;
                                $user->save();
                            }
                        }

                        $orderDTO->setId($order->id);
                        $orderDTO->setUserId($order->user_id);
                        $this->repo->update($orderDTO);
                    }
                }
            }
        }
    }

    public function checkSubscriptionStatus(Collection $orders)
    {
        /** @var Collection $apiProviders */
        $apiProviders = ApiProviderFacade::list(new ApiProviderAllRequest());
        $apiProviders = $apiProviders->keyBy('id')->toArray();

        /**
         * @var Order $order
         */
        foreach ($orders as $order) {
            if (isset($apiProviders[$order->api_provider_id])) {
                $dataPost = [
                    'key' 	   => $apiProviders[$order->api_provider_id]['key'],
                    'action'   => 'status',
                    'order'    => $order->api_order_id,
                ];

                $response = $this->apiService->connectApi(
                    $apiProviders[$order->api_provider_id]['url'],
                    $dataPost
                );

                $this->checkResponseError($response, $order);

                if (!empty($response['status']) && $response['status'] != "") {
                    $orderDTO = new OrderItemDTO();

                    $orderDTO->setSubStatus($response['status']);
                    $orderDTO->setSubResponseOrders(json_encode($response['orders']));
                    $orderDTO->setSubResponsePosts($response['posts']);
                    $orderDTO->setNote("");

                    if (
                        $response['status'] == Order::ORDER_SUB_STATUS_COMPLETED
                        || $response['status'] == Order::ORDER_SUB_STATUS_CANCELED
                    ) {
                        $orderDTO->setStatus(strtolower($response['status']));
                    }

                    /*----------  Inseret New Order for subscription  ----------*/
                    if (isset($response['orders'])) {
                        $dbResponseOrders = json_decode($order->sub_response_orders);
                        if (isset($dbResponseOrders->orders)) {
                            $newSubscriptionOrders = array_diff($response['orders'], $dbResponseOrders->orders);
                        }else{
                            $newSubscriptionOrders = $response['orders'];
                        }

                        if (!empty($newSubscriptionOrders)) {

                            $serviceInfoRequest = new ServiceInfoRequest();
                            $serviceInfoRequest->merge([
                                'id' => $order->service_id
                            ]);

                            /** @var Service $service */
                            $service = ServiceFacade::info($serviceInfoRequest);

                            $this->repo->insertOrderFromDripFeedSubscription(
                                $order,
                                $apiProviders[$order->api_provider_id],
                                $newSubscriptionOrders,
                                $service
                            );
                        }
                    }

                    $orderDTO->setId($order->id);
                    $orderDTO->setUserId($order->user_id);
                    $this->repo->update($orderDTO);
                }
            }

        }
    }

    private function checkResponseError(array $response, Order $order): void
    {
        if (isset($response['errors']) || (isset($response['error']) && $response['error'] != "")) {
            $orderDTO = new OrderItemDTO();
            $orderDTO->setId($order->id);
            $orderDTO->setUserId($order->user_id);
            $orderDTO->setStatus(Order::ORDER_STATUS_ERROR);

            $this->repo->update($orderDTO);
        }
    }
}
