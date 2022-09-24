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
            $table->integer('train_no')->unique();
            $table->string('train_model');
            $table->integer('no_of_cars');
            $table->unsignedBigInteger('admin')->nullable();
            $table->foreign('admin')->references('id')->on('admins')->onDelete('set null');
            $table->string('status')->default("true"); ## opposite -> false , to indicate the status of the train
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
