<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('clientOutput');
            $table->string('dayStay');
            $table->string('hourStay');
            $table->string('disscountClient')->nullable();
            $table->string('observations')->nullable();
            $table->string('numberInvoice');
            $table->string('total');
            $table->string('subTotal');
            $table->string('iva');
            $table->string('valueStay');
            $table->string('delete')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('register_invoices');
    }
}
