<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterBoookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_boookings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('timeEnter');
            $table->date('timeGetout');
            $table->string('personsQuantity');
            $table->string('observations');
            $table->string('email');
            $table->string('name');
            $table->string('phone');
            $table->string('advance');
            $table->string('state')->nullable();
            $table->string('delete')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('register_boookings');
    }
}
