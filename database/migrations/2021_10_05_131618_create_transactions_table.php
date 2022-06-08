<?php

    use App\Models\Transaction;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

//'order_id',
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('payer_email');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->double('txn_fee')->nullable();
            $table->integer('amount');
            $table->tinyInteger('status')->default(Transaction::STATUS_NEW);
            $table->string('system_hash')->nullable();
            $table->string('currency')->default("USD");
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
        Schema::dropIfExists('transactions');
    }
}
