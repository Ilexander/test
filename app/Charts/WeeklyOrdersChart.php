<?php

namespace App\Charts;

use App\Http\Requests\Order\OrderAllRequest;
use App\Models\Order;
use App\Services\Order\OrderFacade;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class WeeklyOrdersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $all = new OrderAllRequest();
        $all->merge([
            'start_date' => date('Y-m-d',strtotime("-6 day")),
            'end_date'   => date('Y-m-d'),
            'user_id'    => !Auth::user()->isAdmin() ? Auth::user()->id : null
        ]);

        $defaultValues = [
            date('Y-m-d',strtotime("-6 day"))   => 0,
            date('Y-m-d',strtotime("-5 day"))   => 0,
            date('Y-m-d',strtotime("-4 day"))   => 0,
            date('Y-m-d',strtotime("-3 day"))   => 0,
            date('Y-m-d',strtotime("-2 day"))   => 0,
            date('Y-m-d',strtotime("-1 day"))   => 0,
            date('Y-m-d')                                => 0
        ];

        $result = [
            Order::ORDER_STATUS_COMPLETED   => $defaultValues,
            Order::ORDER_STATUS_PROCESSING  => $defaultValues,
            Order::ORDER_STATUS_PENDING     => $defaultValues,
            Order::ORDER_STATUS_IN_PROGRESS => $defaultValues,
            Order::ORDER_STATUS_PARTIAL     => $defaultValues,
            Order::ORDER_STATUS_CANCELED    => $defaultValues,
            Order::ORDER_STATUS_REFUNDED    => $defaultValues
        ];

        $orders = OrderFacade::all($all);

        $searchStatuses = array_keys($result);

        /** @var Order $order */
        foreach ($orders as $order) {
            if (in_array($order->status, $searchStatuses)) {
                if (isset($result[$order->status][$order->created_at->format("Y-m-d")])) {
                    $result[$order->status][$order->created_at->format("Y-m-d")]++;
                } else {
                    $result[$order->status][$order->created_at->format("Y-m-d")] = 0;
                }
            }
        }

        $chart = $this->chart->lineChart()
            ->setTitle('Weekly Recent Orders');

        foreach ($result as $key => $item) {
            $chart->addData($key, [
                $item[date('Y-m-d',strtotime("-6 day"))],
                $item[date('Y-m-d',strtotime("-5 day"))],
                $item[date('Y-m-d',strtotime("-4 day"))],
                $item[date('Y-m-d',strtotime("-3 day"))],
                $item[date('Y-m-d',strtotime("-2 day"))],
                $item[date('Y-m-d',strtotime("-1 day"))],
                $item[date('Y-m-d')],
            ]);
        }

        $chart->setXAxis(array_keys($defaultValues));

        return $chart;
    }
}
