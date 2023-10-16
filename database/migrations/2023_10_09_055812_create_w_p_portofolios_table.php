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
        Schema::create('w_p_portofolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wedding_photographer_id');
            $table->string('judul');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->timestamps();

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
        Schema::dropIfExists('w_p_portofolios');
    }
};
