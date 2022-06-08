<?php

namespace App\Console\Commands;

use App\Services\Order\OrderService;
use Illuminate\Console\Command;

class OrderStatusSubscriptionsExecuteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:subscriptions-execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(OrderService $orderService)
    {
        $orders = $orderService->getSubscriptionOrders();

        return 0;
    }
}
