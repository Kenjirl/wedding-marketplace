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
        Schema::create('w_o_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wedding_id');
            $table->unsignedBigInteger('w_o_plan_id');
            $table->enum('status', ['diproses', 'ditolak', 'diterima', 'selesai']);
            $table->string('bukti_bayar');
            $table->date('untuk_tanggal');
            $table->timestamps();

            $table->foreign('wedding_id')->references('id')->on('weddings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('w_o_plan_id')->references('id')->on('w_o_plans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_o_bookings');
    }
};
