<?php

    use App\Models\User;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('role_id');
            $table->tinyInteger('login_type')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('timezone')->nullable();
            $table->text('more_information')->nullable();
            $table->text('desc')->nullable();
            $table->bigInteger('balance')->default(0);
            $table->integer('custom_rate')->default(1);
            $table->string('api_key')->nullable();
            $table->bigInteger('spent')->default(0);
            $table->string('activation_key')->nullable();
            $table->tinyInteger('status')->default(User::STATUS_BLOCKED);
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
        Schema::dropIfExists('users');
    }
}
