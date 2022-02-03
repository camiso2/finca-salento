<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('selectedBedroom');
            $table->string('order');
            $table->string('valueOrder');
            $table->string('numberInvoice')->nullable();
            $table->string('state')->nullable();
            $table->string('delete')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('debroom_id')->unsigned();
            $table->foreign('debroom_id')->references('id')->on('register_bedrooms');
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
        Schema::dropIfExists('register_orders');
    }
}
