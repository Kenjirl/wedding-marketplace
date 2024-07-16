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
        Schema::create('w_v_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_c_wedding_id');
            $table->unsignedBigInteger('w_vendor_id');
            $table->unsignedBigInteger('w_v_plan_id');
            $table->unsignedInteger('qty');
            $table->enum('status', ['batal', 'diproses', 'diterima', 'ditolak', 'dibayar', 'selesai'])->default('diproses');
            $table->date('untuk_tanggal');
            $table->unsignedBigInteger('total_bayar');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('w_c_wedding_id')->references('id')->on('w_c_weddings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('w_vendor_id')->references('id')->on('w_vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('w_v_plan_id')->references('id')->on('w_v_plans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_v_bookings');
    }
};
