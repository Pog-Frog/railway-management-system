<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('captains')->onDelete('set null');
            $table->unsignedBigInteger('employee')->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->unsignedBigInteger('line')->nullable();
            $table->foreign('line')->references('id')->on('lines')->onDelete('set null');
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
        Schema::dropIfExists('trips');
    }
}
