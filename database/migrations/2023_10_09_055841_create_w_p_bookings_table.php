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
            $table->unsignedBigInteger('w_c_wedding_id');
            $table->unsignedBigInteger('w_p_plan_id');
            $table->enum('status', ['diproses', 'ditolak', 'diterima', 'selesai'])->default('diproses');
            $table->string('bukti_bayar');
            $table->date('untuk_tanggal');
            $table->timestamps();

            $table->foreign('w_c_wedding_id')->references('id')->on('w_c_weddings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('w_p_plan_id')->references('id')->on('w_p_plans')->onUpdate('cascade')->onDelete('cascade');
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
