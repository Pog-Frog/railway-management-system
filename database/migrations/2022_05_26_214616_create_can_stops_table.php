<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('can_stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('train')->nullable();
            $table->foreign('train')->references('id')->on('trains')->onDelete('set null');
            $table->unsignedBigInteger('station')->nullable();
            $table->foreign('station')->references('id')->on('stations')->onDelete('set null');
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
        Schema::dropIfExists('can_stops');
    }
}
