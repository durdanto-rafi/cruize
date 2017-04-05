<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cabin_number');
            $table->integer('guest_id');
            $table->integer('number_of_guest');
            $table->integer('payment_status');
            $table->datetime('device_date');
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
         Schema::drop("guests");
    }
}
