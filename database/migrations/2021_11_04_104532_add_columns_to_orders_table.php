<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->enum('type', Order::ORDER_TYPE_LIST)->default('direct');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedBigInteger('main_order_id')->nullable();
            $table->string('service_type')->nullable()->default('default');
            $table->unsignedBigInteger('api_provider_id')->nullable();
            $table->foreign('api_provider_id')->references('id')->on('api_providers');
            $table->string('api_service_id')->nullable();
            $table->integer('api_order_id')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('link')->nullable();
            $table->string('quantity')->nullable();
            $table->text('usernames')->nullable();
            $table->text('username')->nullable();
            $table->text('hashtags')->nullable();
            $table->text('hashtag')->nullable();
            $table->text('media')->nullable();
            $table->text('comments')->nullable();
            $table->integer('sub_posts')->nullable();
            $table->integer('sub_min')->nullable();
            $table->integer('sub_max')->nullable();
            $table->integer('sub_delay')->nullable();
            $table->text('sub_expiry')->nullable();
            $table->text('sub_response_orders')->nullable();
            $table->text('sub_response_posts')->nullable();
            $table->enum('sub_status', Order::ORDER_SUB_STATUS_LIST)->nullable();
            $table->decimal('charge', 15,4)->nullable();
            $table->decimal('formal_charge', 15,4)->nullable();
            $table->decimal('profit', 15,4)->nullable();
            $table->enum('status', Order::ORDER_STATUS_LIST)->nullable()->default('pending');
            $table->string('start_counter')->nullable();
            $table->string('remains')->nullable()->default(0);
            $table->boolean('is_drip_feed')->nullable()->default(false);
            $table->integer('runs')->nullable()->default(0);
            $table->integer('interval')->nullable()->default(0);
            $table->string('dripfeed_quantity')->nullable()->default(0);
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn("type");
            $table->dropForeign('orders_category_id_foreign');
            $table->dropColumn("category_id");
            $table->dropForeign('orders_service_id_foreign');
            $table->dropColumn("service_id");
            $table->dropColumn("main_order_id");
            $table->dropColumn("service_type");
            $table->dropForeign('orders_api_provider_id_foreign');
            $table->dropColumn("api_provider_id");
            $table->dropColumn("api_service_id");
            $table->dropColumn("api_order_id");
            $table->dropForeign('orders_user_id_foreign');
            $table->dropColumn("user_id");
            $table->dropColumn("link");
            $table->dropColumn("quantity");
            $table->dropColumn("usernames");
            $table->dropColumn("username");
            $table->dropColumn("hashtags");
            $table->dropColumn("hashtag");
            $table->dropColumn("media");
            $table->dropColumn("comments");
            $table->dropColumn("sub_posts");
            $table->dropColumn("sub_min");
            $table->dropColumn("sub_max");
            $table->dropColumn("sub_delay");
            $table->dropColumn("sub_expiry");
            $table->dropColumn("sub_response_orders");
            $table->dropColumn("sub_response_posts");
            $table->dropColumn("sub_status");
            $table->dropColumn("charge");
            $table->dropColumn("formal_charge");
            $table->dropColumn("profit");
            $table->dropColumn("status");
            $table->dropColumn("start_counter");
            $table->dropColumn("remains");
            $table->dropColumn("is_drip_feed");
            $table->dropColumn("runs");
            $table->dropColumn("interval");
            $table->dropColumn("dripfeed_quantity");
            $table->dropColumn("note");
        });
    }
}
