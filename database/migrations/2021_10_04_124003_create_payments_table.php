<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->string('type')->unique();
            $table->integer('min')->default(0);
            $table->integer('max')->default(0);
            $table->boolean('status')->default(false);
            $table->boolean('take_fee_from_user')->default(false);
            $table->string('client_id')->nullable();
            $table->string('secret_key')->nullable();
            $table->integer('limit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
