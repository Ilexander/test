<?php

namespace App\Charts;

use App\Http\Requests\Order\OrderAllRequest;
use App\Models\Order;
use App\Services\Order\OrderFacade;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class OrdersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $all = new OrderAllRequest();
        $all->merge([
            'start_date' => date('Y-m-d',strtotime("-6 day")),
            'end_date'   => date('Y-m-d'),
            'user_id'    => !Auth::user()->isAdmin() ? Auth::user()->id : null
        ]);

        $result = [
            Order::ORDER_STATUS_COMPLETED   => 0,
            Order::ORDER_STATUS_PROCESSING  => 0,
            Order::ORDER_STATUS_PENDING     => 0,
            Order::ORDER_STATUS_IN_PROGRESS => 0,
            Order::ORDER_STATUS_PARTIAL     => 0,
            Order::ORDER_STATUS_CANCELED    => 0,
            Order::ORDER_STATUS_REFUNDED    => 0
        ];

        $orders = OrderFacade::all($all);

        $searchStatuses = array_keys($result);

        /** @var Order $item */
        foreach ($orders as $item) {
            if (in_array($item->status, $searchStatuses)) {
                $result[$item->status]++;
            }
        }

        return $this->chart->pieChart()
            ->setTitle('Recent Orders')
            ->addData([
                    $result[Order::ORDER_STATUS_COMPLETED],
                    $result[Order::ORDER_STATUS_PROCESSING],
                    $result[Order::ORDER_STATUS_PENDING],
                    $result[Order::ORDER_STATUS_IN_PROGRESS],
                    $result[Order::ORDER_STATUS_PARTIAL],
                    $result[Order::ORDER_STATUS_CANCELED],
                    $result[Order::ORDER_STATUS_REFUNDED],
                ])
            ->setLabels($searchStatuses);
    }
}
