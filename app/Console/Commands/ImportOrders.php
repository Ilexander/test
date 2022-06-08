<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:orders';

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
    public function handle()
    {
        $res = DB::connection('top_follow')
            ->table('orders')
            ->orderBy('id')
            ->where('id', '>', 583602)
            ->each(function ($order) {
                    $user = User::query()
                        ->where('id', $order->uid)
                        ->first();

                    Order::query()
                        ->insert([
                            "id"              => $order->id,
                            "type"              => $order->type,
                            "category_id"       => $order->cate_id,
                            "service_id"    => $order->service_id,
                            "main_order_id" => $order->main_order_id,
                            "service_type"  => $order->service_type,
                            "api_provider_id"   => $order->api_provider_id,
                            "api_service_id"    => $order->api_service_id,
                            "api_order_id"  => $order->api_order_id,
                            "user_id"   => $user->id ?? 1,
                            "link"  => $order->link,
                            "quantity"  => $order->quantity,
                            "usernames" => $order->usernames,
                            "username"  => $order->username,
                            "hashtags"  => $order->hashtags,
                            "hashtag"   => $order->hashtag,
                            "media" => $order->media,
                            "comments"  => $order->comments,
                            "sub_posts" => $order->sub_posts,
                            "sub_min"   => $order->sub_min,
                            "sub_max"   => $order->sub_max,
                            "sub_delay" => $order->sub_delay,
                            "sub_expiry"    => $order->sub_expiry,
                            "sub_response_orders"   => $order->sub_response_orders,
                            "sub_response_posts"    => $order->sub_response_posts,
                            "sub_status"    => $order->sub_status,
                            "charge"    => $order->charge,
                            "formal_charge" => $order->formal_charge,
                            "profit"    => $order->profit,
                            "status"    => $order->status,
                            "start_counter" => $order->start_counter,
                            "remains"   => $order->remains,
                            "is_drip_feed"  => $order->is_drip_feed,
                            "runs"  => $order->runs,
                            "interval"  => $order->interval,
                            "dripfeed_quantity" => $order->dripfeed_quantity,
                            "note"  => $order->note,
                        ]);
            });
    }
}
