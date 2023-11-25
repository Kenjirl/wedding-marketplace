<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_c_wedding_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_c_wedding_id');
            $table->unsignedBigInteger('w_event_id');
            $table->dateTime('waktu');
            $table->string('lokasi');
            $table->timestamps();

            $table->foreign('w_c_wedding_id')->references('id')->on('w_c_weddings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('w_event_id')->references('id')->on('w_events')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_c_wedding_details');
    }
};
