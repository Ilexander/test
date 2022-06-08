<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiDocParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_doc_params', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_doc_id');
            $table->foreign('api_doc_id')->references('id')->on('api_docs');
            $table->string('parameter');
            $table->string('description');
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
        Schema::dropIfExists('api_doc_params');
    }
}
