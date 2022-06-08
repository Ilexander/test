<?php

namespace App\Interfaces\Repositories;

use App\DTO\Order\OrderItemDTO;
use App\DTO\Service\ServiceItemDTO;
use App\Http\Requests\Order\OrderAllInterface;
use App\Http\Requests\Order\OrderCreateInterface;
use App\Http\Requests\Order\OrderDeleteInterface;
use App\Http\Requests\Order\OrderInfoInterface;
use App\Models\ApiProvider;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderInterface
{
    /**
     * @param OrderAllInterface $all
     * @return LengthAwarePaginator
     */
    public function all(OrderAllInterface $all): LengthAwarePaginator;

    /**
     * @param OrderInfoInterface $info
     * @return Model
     */
    public function info(OrderInfoInterface $info): Model;

    /**
     * @param OrderCreateInterface $create
     * @param ServiceItemDTO $serviceItemDTO
     * @return Model
     */
    public function create(OrderCreateInterface $create, ServiceItemDTO $serviceItemDTO): Model;

    /**
     * @param OrderItemDTO $update
     * @return bool
     */
    public function update(OrderItemDTO $update): bool;

    /**
     * @param OrderDeleteInterface $delete
     * @return bool
     */
    public function delete(OrderDeleteInterface $delete): bool;

    public function removeOrdersWithoutValidLink(): void;

    public function getUnrealizeOrders(): Collection;

    public function getStartedOrders(): Collection;

    public function insertOrderFromDripFeedSubscription(
        Order $order,
        ApiProvider $api,
        $newDripFeedOrders,
        Service $service
    ): bool;

    public function getSubscriptionOrders(): Collection;

    public function getProfitStatistic(): object;

    public function statusesStatistic(?int $user_id): array;
}
