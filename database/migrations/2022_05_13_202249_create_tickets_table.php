<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('trip');
            $table->foreign('trip')->references('id')->on('trips')->onDelete('cascade');
            $table->unsignedBigInteger('departure_station');
            $table->foreign('departure_station')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('arrival_station');
            $table->foreign('arrival_station')->references('id')->on('stations')->onDelete('cascade');
            $table->dateTime('departure_date');
            $table->dateTime('arrival_date');
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
        Schema::dropIfExists('tickets');
    }
}
