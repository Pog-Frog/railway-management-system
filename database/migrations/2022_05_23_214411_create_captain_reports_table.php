<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captain_reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('captains')->onDelete('set null');
            $table->unsignedBigInteger('tech')->nullable(); ///
            $table->foreign('tech')->references('id')->on('technicians')->onDelete('set null'); ///
            $table->unsignedBigInteger('train')->nullable();
            $table->foreign('train')->references('id')->on('trains')->onDelete('set null');
            $table->string('writingReport');
            $table->string('report name');
            $table->string('status');
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
        Schema::dropIfExists('captin_reports');
    }
}
