<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterBedroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_bedrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('airConditioning');
            $table->string('bedQuantity');
            $table->string('cooling');
            $table->string('dayRoomCost');
            $table->string('furniture');
            $table->string('fileImage')->nullable();
            $table->string('internet');
            $table->string('jacuzzi');
            $table->string('name');
            $table->string('privateBathroom');
            $table->string('roomWindow');
            $table->string('rradio');
            $table->string('telephoneService');
            $table->string('tv');
            $table->string('typeBedrooms');
            $table->string('state')->nullable();
            $table->string('codeRoom')->nullable();
            $table->string('delete')->nullable();
            $table->string('occupation')->nullable();
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
        Schema::dropIfExists('register_bedrooms');
    }
}
