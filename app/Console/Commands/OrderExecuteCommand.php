<?php

namespace App\Console\Commands;

use App\Services\Order\OrderService;
use Illuminate\Console\Command;

class OrderExecuteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute order';

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
//        $orderService->removeOrdersWithWrongLink();
        $orders = $orderService->getOrdersForExecution();
        $orderService->executeOrders($orders);

        return 0;
    }
}
