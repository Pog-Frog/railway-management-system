<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedTrainsForLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned__trains_for__lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('captains')->onDelete('set null');
            $table->unsignedBigInteger('line')->nullable();
            $table->foreign('line')->references('id')->on('lines')->onDelete('set null');
            $table->unsignedBigInteger('train')->nullable();
            $table->foreign('train')->references('id')->on('trains')->onDelete('set null');
            $table->unsignedBigInteger('admin')->nullable();
            $table->foreign('admin')->references('id')->on('admins')->onDelete('set null');
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
        Schema::dropIfExists('assigned__trains_for__lines');
    }
}
