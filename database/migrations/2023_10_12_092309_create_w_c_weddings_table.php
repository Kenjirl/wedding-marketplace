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
        Schema::create('w_c_weddings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wedding_couple_id');
            $table->string('groom');
            $table->string('bride');
            $table->dateTime('waktu_pemberkatan');
            $table->dateTime('waktu_perayaan');
            $table->string('lokasi_pemberkatan');
            $table->string('lokasi_perayaan');
            $table->timestamps();

            $table->foreign('wedding_couple_id')->references('id')->on('wedding_couples')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_c_weddings');
    }
};
