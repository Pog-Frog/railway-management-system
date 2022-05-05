<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->unsignedBigInteger('type')->nullable();
            $table->foreign('type')->references('id')->on('train_types')->onDelete('set null');
            $table->integer('no_of_cars');
            $table->string('status')->default("true"); ## opposite -> false , to indicate the status of the train
            $table->unsignedBigInteger('line')->nullable();
            $table->foreign('line')->references('id')->on('lines')->onDelete('set null');
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('captains')->onDelete('set null');
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
        Schema::dropIfExists('trains');
    }
}
