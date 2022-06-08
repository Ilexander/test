<?php

namespace App\Repositories\Order;

use App\DTO\Order\OrderItemDTO;
use App\DTO\Service\ServiceItemDTO;
use App\Helpers\ArrayHelper;
use App\Http\Requests\Order\OrderAllInterface;
use App\Http\Requests\Order\OrderCreateInterface;
use App\Http\Requests\Order\OrderDeleteInterface;
use App\Http\Requests\Order\OrderInfoInterface;
use App\Interfaces\Repositories\OrderInterface;
use App\Models\ApiProvider;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderInterface
{
    private Order $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @param OrderAllInterface $all
     * @return LengthAwarePaginator
     */
    public function all(OrderAllInterface $all): LengthAwarePaginator
    {
        return $this
            ->order
            ->newQuery()
            ->with(['user', 'service'])
            ->when($all->getId(), function ($query, $id) {
                return $query->whereIn('id', $id);
            })
            ->when((!Auth::user()->isAdmin()), function ($query, $user){
                return $query->where('user_id', Auth::user()->id);
            })
            ->when($all->getStatus(), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when(( $all->getSearchField() ), function ($query, $searchField) use ($all) {
                if (in_array($all->getSearchField(), ['id', 'api_order_id', 'link'])) {
                    return $query->where($searchField, 'like', '%'.$all->getSearch().'%');
                }

                return $query
                    ->join(
                        (new User())->getTable().' as u',
                        'orders.user_id', '=', 'u.id'
                    )
                    ->where('u.email', 'like', '%'.$all->getSearch().'%');
            })
            ->when($all->getStartDate(), function ($query, $startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($all->getEndDate(), function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->when($all->getUserId(), function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->when($all->isIsDripFeed(), function ($query, $is_drip_feed) {
                return $query->where('is_drip_feed', $is_drip_feed);
            })
            ->when($all->getSortField(), function ($query, $sort) use ($all){
                return $query->orderBy($sort, ($all->getSortType() ?? 'desc'));
            })
            ->when(!$all->getSortField(), function ($query, $sort) use ($all){
                return $query->orderBy('id', 'desc');
            })

//            ->when($all->getLimit(), function ($query, $limit) {
//                return $query->limit($limit);
//            })
            ->paginate($all->getLimit() ?? 10);
    }

    /**
     * @param OrderInfoInterface $info
     * @return Model
     */
    public function info(OrderInfoInterface $info): Model
    {
        return $this
            ->order
            ->newQuery()
            ->where('id', $info->getId())
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('user_id', Auth::user()->id);
            })
            ->with(['user', 'service'])
            ->firstOrFail();
    }

    /**
     * @param OrderCreateInterface $create
     * @param ServiceItemDTO $serviceItemDTO
     * @return Model
     */
    public function create(
        OrderCreateInterface $create,
        ServiceItemDTO $serviceItemDTO
    ): Model {
        $link = $create->getLink();

        $link = str_replace('.com/reel/', '.com/p/', $link);

        if (stripos($link, '?') !== false) {
            $link = strstr($link, '?', true);
        }

        /** @var Order $order */
        $order = new $this->order();
        $order->fill(ArrayHelper::filterEmpty([
            "type"                      => Order::ORDER_TYPE_DIRECT,
            "category_id"               => $create->getCategoryId(),
            "service_id"                => $create->getServiceId(),
            "service_type"              => $serviceItemDTO->getType(),
            "api_provider_id"           => $serviceItemDTO->getApiProviderId(),
            "api_service_id"            => $serviceItemDTO->getApiServiceId(),
            "user_id"                   => $create->getUserId(),
            "link"                      => $link,
            "quantity"                  => $create->getQuantity(),
            "charge"                    => $serviceItemDTO->getPrice(),
            "formal_charge"             => $serviceItemDTO->getOriginalPrice(),
            "profit"                    => abs($serviceItemDTO->getOriginalPrice() - $serviceItemDTO->getPrice()),
            "status"                    => Order::ORDER_STATUS_PENDING,
            "api_order_id"              => -1
        ]));
        $order->save();

        return $order;
    }

    /**
     * @param OrderItemDTO $update
     * @return bool
     */
    public function update(OrderItemDTO $update): bool
    {
        return $this
            ->order
            ->newQuery()
            ->when((Auth::user() && !Auth::user()->isAdmin() && $update->getUserId()), function ($query, $user) use ($update){
                return $query->where('user_id', $update->getUserId());
            })
            ->where('id', $update->getId())
            ->update(ArrayHelper::filterEmpty([
                "link"                      => $update->getLink(),
                "status"                    => $update->getStatus(),
                "start_counter"             => $update->getStartCounter(),
                "remains"                   => $update->getRemains(),
                "type"                      => $update->getType(),
                "category_id"               => $update->getCategoryId(),
                "service_id"                => $update->getServiceId(),
                "main_order_id"             => $update->getMainOrderId(),
                "service_type"              => $update->getServiceType(),
                "api_provider_id"           => $update->getApiProviderId(),
                "api_service_id"            => $update->getApiServiceId(),
                "api_order_id"              => $update->getApiOrderId(),
                "user_id"                   => $update->getUserId(),
                "quantity"                  => $update->getQuantity(),
                "usernames"                 => $update->getUserNames(),
                "username"                  => $update->getUserName(),
                "hashtags"                  => $update->getHashTags(),
                "hashtag"                   => $update->getHashTag(),
                "media"                     => $update->getMedia(),
                "comments"                  => $update->getComments(),
                "sub_posts"                 => $update->getSubPosts(),
                "sub_min"                   => $update->getSubMin(),
                "sub_max"                   => $update->getSubMax(),
                "sub_delay"                 => $update->getSubDelay(),
                "sub_expiry"                => $update->getSubExpiry(),
                "sub_response_orders"       => $update->getSubResponseOrders(),
                "sub_response_posts"        => $update->getSubResponsePosts(),
                "sub_status"                => $update->getSubStatus(),
                "charge"                    => $update->getCharge(),
                "formal_charge"             => $update->getFormalCharge(),
                "profit"                    => $update->getProfit(),
                "is_drip_feed"              => $update->getIsDripFeed(),
                "runs"                      => $update->getRuns(),
                "interval"                  => $update->getInterval(),
                "dripfeed_quantity"         => $update->getDripFeedQuantity(),
                "note"                      => $update->getNote(),
            ]));
    }

    /**
     * @param OrderDeleteInterface $delete
     * @return bool
     */
    public function delete(OrderDeleteInterface $delete): bool
    {
        return $this
            ->order
            ->newQuery()
            ->where('id', $delete->getId())
            ->where('user_id', $delete->getUserId())
            ->delete();
    }

    public function removeOrdersWithoutValidLink(): void
    {
        $this
            ->order
            ->newQuery()
            ->whereNull('link')
            ->orWhere('link', 'not like', 'https://www.instagram.com/%')
            ->delete();
    }

    public function getUnrealizeOrders(): Collection
    {
        return $this
            ->order
            ->newQuery()
            ->where('api_provider_id', '!=', 0)
            ->where('api_order_id', -1)
            ->where(function ($query){
                return $query->where('status', Order::ORDER_STATUS_PENDING)
                    ->orWhere('status', Order::ORDER_STATUS_IN_PROGRESS);
            })
            ->get();
    }

    public function getStartedOrders(): Collection
    {
        return $this
            ->order
            ->newQuery()
            ->where(function ($query){
                return $query
                    ->where('status', Order::ORDER_STATUS_ACTIVE)
                    ->orWhere('status', Order::ORDER_STATUS_PROCESSING)
                    ->orWhere('status', Order::ORDER_STATUS_IN_PROGRESS)
                    ->orWhere('status', Order::ORDER_STATUS_PENDING)
                    ->orWhere('status', '');
            })
            ->where('api_provider_id', '!=', 0)
            ->where('api_order_id', '>', 0)
            ->where('service_type', '!=', "")
            ->get();
    }

    public function insertOrderFromDripFeedSubscription(
        Order $order,
        ApiProvider $api,
        $newDripFeedOrders,
        Service $service
    ): bool {
        $dataOrdersBatch = [];

        foreach ($newDripFeedOrders as $key => $orderId) {
            $existsOrder = $this
                ->order
                ->newQuery()
                ->where('api_order_id', $orderId)
                ->where('service_id', $order->service_id)
                ->where('api_provider_id', $order->api_provider_id)
                ->first();
            if (!is_null($existsOrder)) {
                continue;
            }

            $dataOrder = array(
                "user_id" 	        	        => $order->user_id,
                "category_id" 	    	        => $order->category_id,
                "service_id" 		            => $order->service_id,
                "main_order_id" 		        => $order->id,
                "service_type" 		            => "default",
                "api_provider_id"  	            => $order->api_provider_id,
                "api_service_id"  	            => $order->api_service_id,
                "api_order_id"  	            => $orderId,
                "status"  	                    => 'pending',
            );

            $totalCharge = 1;

            if ($order->is_drip_feed) {
                $dataOrder['link']     = $order->link;
                $dataOrder['quantity'] = $order->dripfeed_quantity;
                $totalCharge           = ($order->dripfeed_quantity * $service->price)/1000;
                $dataOrder['charge']   = $totalCharge;

            }else if ($order->service_type == "subscriptions") {
                $dataOrder['link']               = "https://www.instagram.com/".$order->username;
                $dataOrder['quantity']           = $order->sub_max;
                $dataOrder['sub_response_posts'] = 1; //1: Order default for Subscriptions
                $totalCharge         = ($order->sub_max * $service->price)/1000;
                $dataOrder['charge'] = $totalCharge;


                //TODO Make user balance update
                //$this->update_fund_to_user($order->user_id, $total_charge);
            }

            $dataOrder['formal_charge'] = ($service->original_price * $totalCharge) / $service->price;
            $dataOrder['profit']        = $totalCharge - $dataOrder['formal_charge'];

            $dataOrdersBatch[] = $totalCharge;
        }

        if (!empty($dataOrdersBatch)) {
            $this->order->newQuery()->insert($dataOrdersBatch);
            return true;
        }

        return false;
    }

    public function getSubscriptionOrders(): Collection
    {
        return $this
            ->order
            ->newQuery()
            ->where(function ($query){
                return $query->where('sub_status', Order::ORDER_SUB_STATUS_ACTIVE)
                    ->orWhere('sub_status', Order::ORDER_SUB_STATUS_PAUSED)
                    ->orWhere('status', '');
            })
            ->where('api_provider_id', '!=', 0)
            ->where('api_order_id', '>', 0)
            ->where('service_type', 'subscriptions')
            ->get();
    }

    public function getProfitStatistic(): object
    {
        return DB::table((new Order())->getTable())
            ->select(
                DB::raw('COUNT(*) as orders'),
                DB::raw('SUM(
                    IF(
                        created_at > "'.date('Y-m-d').' 00:00:00"
                        AND created_at < "'.date('Y-m-d').' 23:59:59", profit, 0
                       )
                    ) as today_profit'),
                DB::raw('SUM(
                    IF(
                        created_at > "'.date('Y-m-d',strtotime("-30 day")).' 00:00:00"
                        AND created_at < "'.date('Y-m-d').' 23:59:59", profit, 0
                       )
                    ) as monthly_profit'),
            )
            ->first();
    }

    public function statusesStatistic(?int $user_id): array
    {
//        return DB::table((new Order())->getTable())
//            ->select(
//                DB::raw('SUM( IF( status = "'.Order::ORDER_STATUS_COMPLETED.'", 1, 0 ) ) as completed_orders'),
//                DB::raw('SUM( IF( status = "'.Order::ORDER_STATUS_PROCESSING.'", 1, 0 ) ) as processing_orders'),
//                DB::raw('SUM( IF( status = "'.Order::ORDER_STATUS_PENDING.'", 1, 0 ) ) as pending_orders'),
//                DB::raw('SUM( IF( status = "'.Order::ORDER_STATUS_IN_PROGRESS.'", 1, 0 ) ) as inprogress_orders'),
//                DB::raw('SUM( IF( status = "'.Order::ORDER_STATUS_PARTIAL.'", 1, 0 ) ) as partial_orders'),
//                DB::raw('SUM( IF( status = "'.Order::ORDER_STATUS_CANCELED.'", 1, 0 ) ) as canceled_orders'),
//                DB::raw('SUM( IF( status = "'.Order::ORDER_STATUS_REFUNDED.'", 1, 0 ) ) as refunded_orders'),
//            )
//            ->first();

        return DB::table((new Order())->getTable())
            ->select(DB::raw("COUNT(*) as count"), 'status')
            ->when($user_id, function ($query, $user_id) {
                return $query->where('user_id', $user_id);
            })
            ->whereIn('status', [
                Order::ORDER_STATUS_COMPLETED,
                Order::ORDER_STATUS_PROCESSING,
                Order::ORDER_STATUS_PENDING,
                Order::ORDER_STATUS_IN_PROGRESS,
                Order::ORDER_STATUS_PARTIAL,
                Order::ORDER_STATUS_CANCELED,
                Order::ORDER_STATUS_REFUNDED,
            ])
            ->groupBy('status')
            ->get()
            ->keyBy('status')
            ->toArray();
    }
}
