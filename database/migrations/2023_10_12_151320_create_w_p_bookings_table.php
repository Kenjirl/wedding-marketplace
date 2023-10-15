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
        Schema::create('w_p_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wedding_couple_id');
            $table->unsignedBigInteger('wedding_photographer_id');
            $table->enum('status', ['diproses', 'ditolak', 'diterima', 'selesai']);
            $table->string('bukti_bayar');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('wedding_couple_id')->references('id')->on('wedding_couples')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('wedding_photographer_id')->references('id')->on('wedding_photographers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_p_bookings');
    }
};
