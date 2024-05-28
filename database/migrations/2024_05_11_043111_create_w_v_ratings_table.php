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
        Schema::create('w_v_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_v_booking_id');
            $table->unsignedInteger('rating');
            $table->string('komentar');
            $table->timestamps();

            $table->foreign('w_v_booking_id')->references('id')->on('w_v_bookings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_v_ratings');
    }
};
